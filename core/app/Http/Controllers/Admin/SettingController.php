<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        // dd($request->all());
        $setting = Charge::all()->first();
        $setting->fixed_charge = $request->fixed_charge;
        $setting->percent_charge = $request->percent_charge;
        $setting->interest_rate = $request->interest_rate;
        $setting->on_signup_bonus = $request->on_signup_bonus;
        $setting->on_signup_ref_bonus = $request->on_signup_ref_bonus;
        $setting->on_money_send_bonus = $request->on_money_send_bonus;
        $setting->set_currency = $request->set_currency;
        
        $setting->save();

        return redirect()->back()->with('st_msg','Successfully Updated');
    }
}
