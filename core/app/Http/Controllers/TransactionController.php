<?php

namespace App\Http\Controllers;

use App\Charge;
use App\MasterTransaction;
use App\Notification;
use App\ReferralTransaction;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username=null)
    {
        $auth_user = auth()->user()->id;
        // dd($auth_user);
        // $users = User::all()->except($auth_user);
        // dd($users);
        return view('user.send_money')
            ->with([      
                'username' => $username
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'user' => 'required|string',
            'amount' => 'required|min:10|numeric'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        if($request->user == null || $request->amount == null)
        {
            return redirect()->back()->with('error','Required Fields');
        }

        if(User::where('username',$request->user)->count() != 1)
        {
            return redirect()->back()->with('error','Invalid User');
        }

        if($request->user == auth()->user()->username)
        {
            return redirect()->back()->with('error','You Cant send money to yourself');
        }
            
        

        $amount = $request->amount;
       
        if(!$this->checkAvailableBalance($amount)){
            return redirect()->route('user.dashboard')->with('error','Insufficient Balance');
        }
            $charge = $this->get_charge($amount);
           
            
            //Sender Details ;
            $sender_id = auth()->user()->id;
            $sender_wallet =auth()->user()->wallet;
            $sender_current_balance = $sender_wallet->current_balance;
            $sender_current_update_balance = $charge['current_balance'];
            $sender_prev_update_balance = $sender_current_balance;
           
            
            $rcvr_id = User::where('username',$request->user)->first()->id;
            $rcvr_wallet = Wallet::where('user_id',$rcvr_id)->first();
            $rcvr_current_balance =$rcvr_wallet->current_balance;
            
            $rcvr_current_update_balance = $rcvr_current_balance + $amount;
            $rcvr_prev_update_balance = $rcvr_current_balance;
            

            // Referal Details;
            $refer_id = User::where('id',$sender_id)->first()->referenced_by;
            if($refer_id!=null)
            {
               
                $refer_wallet = Wallet::where('user_id',$refer_id)->first();
                $refer_current_balance = $refer_wallet->current_balance;
               
                $bonus = Charge::all()->first()->on_money_send_bonus;
                $ON_MONEY_SEND_BONUS = ( $bonus * $refer_current_balance)/100;
                $refer_current_update_balance = $refer_current_balance + $ON_MONEY_SEND_BONUS;
              
                $refer_prev_update_balance = $refer_current_balance;
                $trax_id = $refer_wallet->user->username.Str::random(8).$sender_wallet->user->username;

                $referral_transaction = new ReferralTransaction();
                $referral_transaction->user_id = $refer_id;
                $referral_transaction->trax_id = $trax_id;
                $referral_transaction->transaction_by = $sender_id;
                $referral_transaction->bonus_amount = $ON_MONEY_SEND_BONUS;
                $referral_transaction->status = ReferralTransaction::ON_MONEY_SEND_STATUS;
                $referral_transaction->save();

                $master_transaction = new MasterTransaction();
                $master_transaction->user_id = $refer_id;
                $master_transaction->trax_id = $trax_id;
                $master_transaction->amount = $ON_MONEY_SEND_BONUS;
                $master_transaction->charge = 0;
                $master_transaction->current_balance = $refer_current_update_balance;
                $master_transaction->remarks = "Referral Bonus $bonus (%) interest by ".$sender_wallet->user->name." On Money Send";
                $master_transaction->status = MasterTransaction::CREDITED;
                $master_transaction->save();

               

                 // Referrar Wallet Update
                $refer_wallet->current_balance = $refer_current_update_balance;
                $refer_wallet->prev_balance = $refer_prev_update_balance;
                $refer_wallet->save();


            }else{
                $refer_id = null; 
            }

           
            $sender_name = $sender_wallet->user->name;
            $rcvr_name = $rcvr_wallet->user->name;
            $sender_username = $sender_wallet->user->username;
            $rcvr_username = $rcvr_wallet->user->username;
            $trx_id = $sender_username.Str::random(6).$rcvr_username;

            $master_transaction = new MasterTransaction();
            $master_transaction->user_id = $sender_id;
            $master_transaction->trax_id = $trx_id;
            $master_transaction->amount = $amount;
            $master_transaction->charge = $charge['charge'];
            $master_transaction->current_balance = $sender_current_update_balance;                $master_transaction->remarks = "$sender_name sent to $rcvr_name";
            $master_transaction->status = MasterTransaction::DEBITED;
            $master_transaction->save();

            $master_transaction = new MasterTransaction();
            $master_transaction->user_id = $rcvr_id;
            $master_transaction->trax_id = $trx_id;
            $master_transaction->amount = $amount;
            $master_transaction->charge = 0;
            $master_transaction->current_balance = $rcvr_current_balance + $amount;
            $master_transaction->remarks = "$rcvr_name receive from $sender_name";
            $master_transaction->status = MasterTransaction::CREDITED;
            $master_transaction->save();

            Notification::create([
                'description' => "<div><h3>Title: New Transaction</h3></div><div><h5>Sender Name:<span class='text-danger'> $sender_name</span></h5></div><div><h5>Receiver Name:<span class='text-info'> $rcvr_name</span></h5></div><div><h5>Amount: <span class='text-primary'> $amount</span></h5></div><div><h5>Transaction ID:<span class='text-success'> $trx_id</span></h5></div>",
            ]);
            
            // Sender Wallet Update
                $sender_wallet->current_balance = $sender_current_update_balance;
                $sender_wallet->prev_balance = $sender_prev_update_balance;
                $sender_wallet->save();

            // Rcvr Wallet Update
                $rcvr_wallet->current_balance = $rcvr_current_update_balance;
                $rcvr_wallet->prev_balance = $rcvr_prev_update_balance;
                $rcvr_wallet->save();
            
            return redirect()->route('user.dashboard')->with('success','Transaction Successfull');
        
    }

  

    protected function checkAvailableBalance($amount)
    {
        $user_amount =  auth()->user()->wallet->current_balance;
        $fixed = Charge::all()->first()->fixed_charge;
        $percent = Charge::all()->first()->percent_charge;

        $charge_percent = ($amount*$percent)/100;
        $total_charge = $charge_percent + $fixed;
        $total_money_spend = $amount + $total_charge;

        // dd($charge_percent);
        //  dd($amount <= $user_amount);
        if($total_money_spend >= $user_amount)
        {
            return false;
        }
        return true;
    }

    protected function get_charge($amount)
    {
        $user_amount =  auth()->user()->wallet->current_balance;
        $fixed = Charge::all()->first()->fixed_charge;
        $percent = Charge::all()->first()->percent_charge;

        $charge_percent = ($amount*$percent)/100;
        $total_charge = $charge_percent + $fixed;
        $total_money_spend = $amount + $total_charge;

        $current_balance = $user_amount - $total_money_spend;

        return ['charge'=>$total_charge,'total_spend'=>$total_money_spend,'current_balance'=> $current_balance];
    }
}
