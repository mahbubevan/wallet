<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function test()
    {
        // $email = "evan@evan.com";
        // $arr = explode('@', $email);
        // $length = strlen($arr[0]);
        // $make_username = $arr[0] . Str::random($length);
        // dd($make_username);

        // $user = 5;
        // $wallet = Wallet::where('user_id', $user)->first()->prev_balance;
        $trx_id = 'hello'.Str::random(12).'world';
        dd($trx_id);
    }
}
