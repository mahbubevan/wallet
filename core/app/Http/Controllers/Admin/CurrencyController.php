<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function store(Request $request)
    {
        $currency = $request->currency;

        Currency::create([
            'currency' => $currency
        ]);

        return redirect()->back()->with('success','Currency Added');
    }
}
