<?php

namespace App\Http\Controllers;

use App\ReferralTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('user.profile');
    }

    public function send_ref_link(Request $request)
    {
        if($request->email == null)
        {
            return redirect()->back()->with('error','Invalid Email');
        }
        $user = auth()->user();
        $email = $request->email;
        $username = $user->username;
        $sender_email = $user->email;
        $link = "http://localhost/wallet/user/register/$username";

        $headers = "From: <$sender_email> \r\n";
        $headers .= "Content-Type:text/html; charset=utf-8\r\n";
        $msg = "<h2>Your referral link is <span style='color:green;'><a target='_blank' href='.'$link'.'>$link</a></span><h2>";

        mail($email,'Referral Link',$msg,$headers);

        return redirect()->back()->with('success','Successfully sent');
    }

    public function refer()
    {
        $user = auth()->user();
        $referto = User::where('referenced_by',$user->id)->get();

        return view('user.referlist')->with(['referto'=>$referto]);
    }
}
