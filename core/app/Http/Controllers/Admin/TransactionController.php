<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\MasterTransaction;
use App\ReferralTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function transaction()
    {
        $transactions = MasterTransaction::with('user')->orderBy('created_at','desc')->paginate(10,['*'],'transaction_page'); 
        return view('admin.transaction.user_trans')->with([
            'transactions' => $transactions,
            'currency' => $this->get_currency(),
        ]);
    }

    public function ref_trans()
    {
        $transactions = ReferralTransaction::with('sender','benefit_user')->orderBy('created_at','desc')->paginate(10);
        return view('admin.transaction.ref_trans')->with(
            [
                'transactions'=>$transactions,
                'currency'=>$this->get_currency()
            ]);
    }

    public function admin_trans()
    {
        $transactions = InterestTransaction::with('user','admin')->orderBy('created_at','desc')->paginate(10);
        // dd($transactions);
        return view('admin.transaction.admin_trans')->with(['transactions'=>$transactions,'currency'=>$this->get_currency()]);
    }

    protected function get_currency()
    {
        $currency = Charge::all()->first()->set_currency;

        return $currency;
    }

    

    public function transaction_by_user($id)
    {
        $transactions = MasterTransaction::where('user_id',$id)->orderBy('created_at','desc')->paginate(10);
        return view('admin.user.transaction')->with([
            'id'=>$id,
            'transactions' => $transactions,
            'currency' => $this->get_currency(),
        ]);
    }

    public function send_transaction($id)
    {
        $transactions = MasterTransaction::where('user_id',$id)->where('status',MasterTransaction::DEBITED)->with('user')->orderBy('created_at','desc')->paginate(10);
        return view('admin.user.send')->with([
            'id'=>$id,
            'currency' => $this->get_currency(),
            'transactions' => $transactions
        ]);
    }

    public function rcv_transaction($id)
    {
        $transactions = MasterTransaction::where('user_id',$id)->where('status',MasterTransaction::CREDITED)->with('user')->orderBy('created_at','desc')->paginate(10);
        return view('admin.user.rcv')->with([
            'id'=>$id,
            'currency' => $this->get_currency(),
            'transactions' => $transactions
        ]);
    }

    public function ref_transaction($id)
    {
        $transactions = ReferralTransaction::where('user_id',$id)->with('sender')->with('benefit_user')->orderBy('created_at','desc')->paginate(10);
        return view('admin.user.refer_bonus')->with([
            'id'=>$id,
            'currency' => $this->get_currency(),
            'transactions' => $transactions
        ]);

    }

    public function ref_list($id)
    {
        $ref_users = User::where('referenced_by',$id)->orderBy('created_at','desc')->paginate(10);
        $user_name = User::find($id)->username;

        return view('admin.user.refer_list')->with(['id'=>$id,'ref_users'=>$ref_users,'user_name'=>$user_name]);
    }

    public function admin_trans_by_id($id)
    {
        $transactions = InterestTransaction::where('user_id',$id)->with('user')->orderBy('created_at','desc')->paginate(10);

        return view('admin.user.bonus_admin')->with(['id'=>$id,'transactions'=> $transactions,'currency' => $this->get_currency(),]);
    }

    public function add_balance(Request $request)
    {
        // dd($request->all());
        $wallet = User::where('id',$request->user)->first()->wallet;

        $validator = Validator::make($request->all(),[
            'amount'=>'bail|numeric|min:5|max:25000'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $wallet->prev_balance = $wallet->current_balance;
        $wallet->current_balance = $wallet->current_balance + $request->amount;

        $wallet->save();

        MasterTransaction::create([
            'user_id' => $request->user,
            'trax_id' => Str::random(8),
            'amount' => $request->amount,
            'charge' => 0,
            'current_balance' => $wallet->current_balance,
            'remarks' => 'Balance credited admin',
            'status' => MasterTransaction::CREDITED_BY_ADMIN,
        ]);

        return redirect()->back()->with('success','Successfully Credited');
    }

    public function sub_balance(Request $request)
    {
        $wallet = User::where('id',$request->user)->first()->wallet;
        // dd($wallet->current_balance<$request->amount);
        if($wallet->current_balance<$request->amount){
            return redirect()->back()->with('error','You cant substract this amount');
        }

        $validator = Validator::make($request->all(),[
            'amount'=>'bail|numeric|min:5'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $wallet->prev_balance = $wallet->current_balance;
        $wallet->current_balance = $wallet->current_balance - $request->amount;

        MasterTransaction::create([
            'user_id' => $request->user,
            'trax_id' => Str::random(8),
            'amount' => $request->amount,
            'charge' => 0,
            'current_balance' => $wallet->current_balance,
            'remarks' => 'Balance debited by admin',
            'status' => MasterTransaction::DEBITED_BY_ADMIN,
        ]);

        $wallet->save();

        return redirect()->back()->with('success','Successfully Debited');

    }

    

}
