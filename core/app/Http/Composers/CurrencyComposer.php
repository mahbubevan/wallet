<?php

namespace App\Http\Composers;

use App\Charge;
use Illuminate\Contracts\View\View;

class CurrencyComposer{

    public function compose(View $view)
    {
        $currency = Charge::all()->first();
        // dd($currency);
        $view->with([
            'cr'=>$currency->set_currency,
            'fx' => $currency->fixed_charge,
            'pc' => $currency->percent_charge,
            'osb' => $currency->on_signup_bonus,
            'omsb' => $currency->on_money_send_bonus,
            'osrb' => $currency->on_signup_ref_bonus,
            ]);
    }

}