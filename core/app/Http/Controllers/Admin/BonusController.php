<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\Mail\SystemBonus;
use App\MasterTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BonusController extends Controller
{
    public function update(Request $request)
    {
        // dd($request->bonus);
        $users = User::all();
        foreach($users as $user){
            $user_balance = $user->wallet->current_balance;
            $bonus = ($request->bonus * $user_balance)/100;
            $new_balance = $bonus+$user_balance;
            $user->wallet->current_balance = $new_balance;

            $user->wallet->save();

            $trax_id = $user->username.Str::random(8).auth()->guard('admin')->user()->username;

            $interest_transaction = new InterestTransaction();
            $interest_transaction->user_id = $user->id;
            $interest_transaction->admin_id = auth()->guard('admin')->user()->id;
            $interest_transaction->trax_id = $trax_id;
            $interest_transaction->interest_rate = $request->bonus;
            $interest_transaction->amount = $new_balance;
            $interest_transaction->bonus = $bonus;
            $interest_transaction->save();

            $master_transaction = new MasterTransaction();
            $master_transaction->user_id = $user->id;
            $master_transaction->trax_id = $trax_id;
            $master_transaction->amount = $bonus;
            $master_transaction->charge = 0;
            $master_transaction->current_balance = $new_balance;
            $master_transaction->remarks = "Bonus $bonus on $request->bonus (%) by admin";
            $master_transaction->status = MasterTransaction::CREDITED;
            $master_transaction->save();

            $interest_transaction = InterestTransaction::where('trax_id',$trax_id)->first();
            
            // $when = now()->addSeconds(30);
            // Mail::to($user->email)->queue(new SystemBonus($interest_transaction));
            Mail::to($user->email)->send(new SystemBonus($interest_transaction));
        }



        return redirect()->back()->with('success','Successfully Send');
    }
}
