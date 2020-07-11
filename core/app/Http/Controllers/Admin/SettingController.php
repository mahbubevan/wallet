<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'fixed_charge' => 'bail|required|numeric|min:0',
            'percent_charge' => 'bail|required|numeric|min:0',
            'interest_rate' => 'bail|required|numeric|min:5',
            'on_signup_bonus' => 'bail|required|numeric|min:0',
            'on_signup_ref_bonus' => 'bail|required|numeric|min:0',
            'on_money_send_bonus' => 'bail|required|numeric|min:0',
            'set_currency' => 'bail|required|string',
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $setting = Charge::all()->first();
        $setting->fixed_charge = $request->fixed_charge;
        $setting->percent_charge = $request->percent_charge;
        $setting->interest_rate = $request->interest_rate;
        $setting->on_signup_bonus = $request->on_signup_bonus;
        $setting->on_signup_ref_bonus = $request->on_signup_ref_bonus;
        $setting->on_money_send_bonus = $request->on_money_send_bonus;
        $setting->set_currency = $request->set_currency;
        
        $setting->save();

        return redirect()->back()->with('success','Successfully Updated');
    }
}
