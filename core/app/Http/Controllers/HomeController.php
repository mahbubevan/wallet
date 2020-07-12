<?php

namespace App\Http\Controllers;

use App\Charge;
use App\InterestTransaction;
use App\MasterTransaction;
use App\ReferralTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('user.dashboard');
    }

    public function send_ref_link(Request $request)
    {
        if($request->email == null)
        {
            return redirect()->back()->with('error','Invalid Email');
        }
        $user = auth()->user();
        $email = $request->email;
        $username = $user->username;
        $sender_email = $user->email;
        $link = "http://localhost/wallet/user/register/$username";

        $headers = "From: <$sender_email> \r\n";
        $headers .= "Content-Type:text/html; charset=utf-8\r\n";
        $msg = "<h2>Your referral link is <span style='color:green;'><a target='_blank' href='.'$link'.'>$link</a></span><h2>";

        mail($email,'Referral Link',$msg,$headers);

        return redirect()->back()->with('success','Successfully sent');
    }

    public function refer()
    {
        $user = auth()->user();
        $referto = User::where('referenced_by',$user->id)->get();

        return view('user.referlist')->with(['referto'=>$referto]);
    }

    public function dashboard()
    {
        $transaction_count = MasterTransaction::where('user_id',auth()->user()->id)->count();
        $total_send_money = MasterTransaction::where('status',MasterTransaction::DEBITED)->where('user_id',auth()->user()->id)->count();
        $total_rcv_money = MasterTransaction::where('status',MasterTransaction::CREDITED)->where('user_id',auth()->user()->id)->count();

        $total_send_balance = MasterTransaction::where('status',MasterTransaction::DEBITED)->where('user_id',auth()->user()->id)->sum('amount');
        $total_rcv_balance = MasterTransaction::where('status',MasterTransaction::CREDITED)->where('user_id',auth()->user()->id)->sum('amount');

        $current_balance = auth()->user()->wallet->current_balance;

        $total_referral_user = User::where('referenced_by',auth()->user()->id)->count();
        $total_referral_bonus = ReferralTransaction::where('user_id',auth()->user()->id)->sum('bonus_amount');

        $currecy = Charge::first(['set_currency'])->set_currency;

        $total_sys_bonus = InterestTransaction::where('user_id',auth()->user()->id)->count();
        $total_sys_balance = InterestTransaction::where('user_id',auth()->user()->id)->sum('amount');
        // dd($currecy);
        // dd($total_referral_bonus);
        // dd($total_referral_user);
        // dd($current_balance);
        // dd($transaction_count);
        return view('user.dashboard.dashboard')->with([
            'transacttion_count' => $transaction_count,
            'total_send_money' => $total_send_money,
            'total_rcv_money' => $total_rcv_money,
            'current_balance' => $current_balance,
            'total_referral_user' => $total_referral_user,
            'total_referral_bonus' => $total_referral_bonus,
            'currency' => $currecy,
            'total_send_balance' => $total_send_balance,
            'total_rcv_balance' => $total_rcv_balance,
            'total_sys_bonus' => $total_sys_bonus,
            'total_sys_balance' => $total_sys_balance,
        ]);
    }

    public function transaction()
    {
        $currecy = Charge::first(['set_currency'])->set_currency;
        $transactions = MasterTransaction::where('user_id',auth()->user()->id)->with('user')->orderBy('created_at','desc')->paginate(10);
        // dd($transactions);
        return view('user.dashboard.transaction')->with([
            'transactions' => $transactions,
            'currency' => $currecy,
        ]);
    }

    public function send_transaction()
    {
        $currecy = Charge::first(['set_currency'])->set_currency;
        $transactions = MasterTransaction::where('user_id',auth()->user()->id)->where('status',MasterTransaction::DEBITED)->with('user')->orderBy('created_at','desc')->paginate(10);
        return view('user.dashboard.send_transaction')->with([
            'currency' => $currecy,
            'transactions' => $transactions
        ]);
    }

    public function rcv_transaction()
    {
        $currecy = Charge::first(['set_currency'])->set_currency;
        $transactions = MasterTransaction::where('user_id',auth()->user()->id)->where('status',MasterTransaction::CREDITED)->with('user')->orderBy('created_at','desc')->paginate(10);
        return view('user.dashboard.rcv_transaction')->with([
            'currency' => $currecy,
            'transactions' => $transactions
        ]);
    }

    public function ref_transaction()
    {
        $currecy = Charge::first(['set_currency'])->set_currency;
        $transactions = ReferralTransaction::where('user_id',auth()->user()->id)->with('sender')->orderBy('created_at','desc')->paginate(10);
        return view('user.dashboard.ref_bonus')->with([
            'currency' => $currecy,
            'transactions' => $transactions
        ]);

    }

    public function ref_list()
    {
        $ref_users = User::where('referenced_by',auth()->user()->id)->orderBy('created_at','desc')->paginate(10);

        return view('user.dashboard.ref_userlists')->with(['ref_users'=>$ref_users]);
    }

    public function admin_trans()
    {
        $currecy = Charge::first(['set_currency'])->set_currency;
        $transactions = InterestTransaction::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(10);

        return view('user.dashboard.admin_trans')->with(['transactions'=> $transactions,'currency' => $currecy]);
    }
}
