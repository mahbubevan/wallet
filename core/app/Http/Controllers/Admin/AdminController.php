<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Currency;
use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\MasterTransaction;
use App\ReferralTransaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total_user = User::count();
        $total_transaction = MasterTransaction::count();
        $total_ref_transaction = ReferralTransaction::count();
        $total_trans_by_admin = InterestTransaction::count();
        $total_currency = Currency::count();
        $total_settings = count(Schema::getColumnListing('charges'))-4;

        $today_transactions = MasterTransaction::whereDate('created_at',Carbon::today())->count();
        $new_user = User::whereDate('created_at',Carbon::today())->count();
        // dd($today_transactions);

        // dd($total_user);
        return view('admin.home')->with([
            'total_user' => $total_user,
            'total_transaction' => $total_transaction,
            'total_ref_transaction' => $total_ref_transaction,
            'total_trans_by_admin' => $total_trans_by_admin,
            'total_currency' => $total_currency,
            'total_settings' => $total_settings,
            'new_trans' =>$today_transactions,
            'new_user'=>$new_user,
        ]);
    }

    public function bonus_page()
    {
        $interest_rate = Charge::all()->first()->interest_rate;
        return view('admin.control.bonus_page')->with([
            'interest_rate' => $interest_rate,
        ]);
    }

    public function currency_page()
    {
        return view('admin.control.currency_page');
    }

    public function setting_page()
    {
        $settings = Charge::all()->first();
        $currencies = Currency::all();
        // dd($settings->fixed_charge);
        return view('admin.control.setting_page')->with([
            'settings' => $settings,
            'currencies' => $currencies,
        ]);
    }

    public function loginUsingId($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('user.dashboard')->with('success','Logged In As User');
    }
}
