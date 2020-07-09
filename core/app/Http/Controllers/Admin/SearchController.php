<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\MasterTransaction;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('admin.search.search');
    }

    public function get_data(Request $request)
    {
        $currency = Charge::all()->first()->set_currency;
        $transactions = MasterTransaction::where('trax_id','LIKE',"%{$request->search}%")->with('user')->get();
        $count =  MasterTransaction::where('trax_id','LIKE',"%{$request->search}%")->count();
        return response()->json(
            [
                'data'=>$transactions,
                'currency' => $currency,
                'count' => $count
            ]);
    }
}
