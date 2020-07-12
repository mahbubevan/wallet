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
        // dd($amount);
        if($this->checkAvailableBalance($amount)){
            $charge = $this->get_charge($amount);
            // dd($charge);
            
            //Sender Details ;
            $sender_id = auth()->user()->id;
            $sender_wallet =auth()->user()->wallet;
            $sender_current_balance = $sender_wallet->current_balance;
            $sender_current_update_balance = $charge['current_balance'];
            $sender_prev_update_balance = $sender_current_balance;
            // dd($sender_prev_update_balance);

            // Receiver Details : 
            $rcvr_id = User::where('username',$request->user)->first()->id;
            $rcvr_wallet = Wallet::where('user_id',$rcvr_id)->first();
            $rcvr_current_balance =$rcvr_wallet->current_balance;
            // dd($rcvr_current_balance);
            $rcvr_current_update_balance = $rcvr_current_balance + $amount;
            $rcvr_prev_update_balance = $rcvr_current_balance;
            // dd($rcvr_prev_update_balance);

            // Referal Details;
            $refer_id = User::where('id',$sender_id)->first()->referenced_by;
            if($refer_id!=null)
            {
                // dd('I am ok to go');
                $refer_wallet = Wallet::where('user_id',$refer_id)->first();
                $refer_current_balance = $refer_wallet->current_balance;
                // dd($refer_current_balance);
                $bonus = Charge::all()->first()->on_money_send_bonus;
                $ON_MONEY_SEND_BONUS = ( $bonus * $refer_current_balance)/100;
                $refer_current_update_balance = $refer_current_balance + $ON_MONEY_SEND_BONUS;
                // dd($refer_current_update_balance);
                $refer_prev_update_balance = $refer_current_balance;
                $trax_id = $refer_wallet->user->username.Str::random(8).$sender_wallet->user->username;
                ReferralTransaction::create([
                    'user_id' => $refer_id,
                    'trax_id' => $trax_id,
                    'transaction_by' => $sender_id,
                    'bonus_amount' => $ON_MONEY_SEND_BONUS,
                    'status' => ReferralTransaction::ON_MONEY_SEND_STATUS,
                ]);

                
                MasterTransaction::create([
                    'user_id' => $refer_id,
                    'trax_id' => $trax_id,
                    'amount' => $ON_MONEY_SEND_BONUS,
                    'charge' => 0,
                    'current_balance' => $refer_current_update_balance,
                    'remarks' => "Referral Bonus $bonus (%) interest by ".$sender_wallet->user->name." On Money Send",
                    'status' => MasterTransaction::CREDITED,
                ]);

               

                 // Referrar Wallet Update
                $refer_wallet->current_balance = $refer_current_update_balance;
                $refer_wallet->prev_balance = $refer_prev_update_balance;
                $refer_wallet->save();


            }else{
                $refer_id = null;    // dd($refer_id);
            }

            // Transaction Both For Sender and Rcvr. 

            Transaction::create([
                'user_id' => $sender_id,
                'rcvr' => $rcvr_id,
                'amount' => $amount,
                'charge' => $charge['charge'],
            ]);

            
            $sender_name = $sender_wallet->user->name;
            $rcvr_name = $rcvr_wallet->user->name;
            $sender_username = $sender_wallet->user->username;
            $rcvr_username = $rcvr_wallet->user->username;
            $trx_id = $sender_username.Str::random(6).$rcvr_username;

            MasterTransaction::create([
                'user_id' => $sender_id,
                'trax_id' => $trx_id,
                'amount' => $amount,
                'charge' => $charge['charge'],
                'current_balance' => $sender_current_update_balance,
                'remarks' => "$sender_name sent to $rcvr_name",
                'status' => MasterTransaction::DEBITED,
            ]);

            MasterTransaction::create([
                'user_id' => $rcvr_id,
                'trax_id' => $trx_id,
                'amount' => $amount,
                'charge' => 0,
                'current_balance' => $rcvr_current_balance + $amount,
                'remarks' => "$rcvr_name receive from $sender_name",
                'status' => MasterTransaction::CREDITED,
            ]);

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
        }else{
            return redirect()->route('user.dashboard')->with('error','Insufficient Balance');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
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
