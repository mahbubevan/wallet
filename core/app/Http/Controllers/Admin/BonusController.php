<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\MasterTransaction;
use App\User;
use Illuminate\Http\Request;
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

            InterestTransaction::create([
                'user_id' => $user->id,
                'admin_id' => auth()->guard('admin')->user()->id,
                'trax_id' => $trax_id,
                'interest_rate' => $request->bonus,
                'amount'    => $new_balance,
            ]);

            MasterTransaction::create([
                'user_id' => $user->id,
                'trax_id' => $trax_id,
                'amount' => $bonus,
                'charge' => 0,
                'current_balance' => $new_balance,
                'remarks' => "Bonus $request->bonus (%) by admin",
                'status' => MasterTransaction::CREDITED,
            ]);
        }

        return redirect()->back()->with('success','Successfully Send');
    }
}
