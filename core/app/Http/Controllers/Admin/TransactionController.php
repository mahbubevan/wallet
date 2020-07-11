<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\MasterTransaction;
use App\ReferralTransaction;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

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
        $ref_trans = ReferralTransaction::with('sender','benefit_user')->orderBy('created_at','desc')->paginate(10);
        return view('admin.transaction.ref_trans')->with([
            'ref_trans' => $ref_trans,
            'currency' => $this->get_currency(),
        ]);

    }

    public function admin_trans()
    {
        $trans_by_admin = InterestTransaction::with('user','admin')->orderBy('created_at','desc')->paginate(10);
        $total_amount = InterestTransaction::all()->sum('amount');
        return view('admin.transaction.admin_trans')->with([
            'trans_by_admin' => $trans_by_admin,
            'currency' => $this->get_currency(),
            'total_amount' => $total_amount,
        ]);

    }

    protected function get_currency()
    {
        $currency = Charge::all()->first()->set_currency;

        return $currency;
    }

    

    public function transaction_by_user($id)
    {
        // $user = User::where('id',$id)->with('master_transactions','interest_transactions','bonus_from_transactions')->first();
        // dd($user->id);
        $user = User::with('master_transactions.user','bonus_from_transactions.sender','interest_transactions.user.wallet')->where('id',$id)->first();
        return view('admin.user.transaction')->with([
            'user' => $user,
            'currency' => $this->get_currency(),
        ]);
    }

}
