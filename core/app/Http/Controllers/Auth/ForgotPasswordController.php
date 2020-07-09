<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('user.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $user = User::where('email',$email)->first();

        if(!$user)
        {
            return redirect()->back()->with('message','Invalid User');
        }

        PasswordReset::where('email',$user->email)->delete();
        $token = Str::random(20);
        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $email = $user->email;
        $sender_email = 'support@wallet.com';
        $headers = "From: <$sender_email> \r\n";
        $headers .= "Content-Type:text/html; charset=utf-8\r\n";
        $msg = "Your verification code is <span style='color:green;'>$token</span>";

        mail($email,'Password Reset Code',$msg,$headers);

        return view('user.auth.verify',compact('email'));
    }

    public function verify_token(Request $request)
    {
        $token = $request->verification_code;
        $email = $request->email;
        // $request->validate(['code' => 'required', 'email' => 'required']);
        if (PasswordReset::where('token', $token)->where('email', $email)->count() != 1) {
            return redirect()->route('user.password.request')->with('message','Invalid Token');
        }
        session()->flash('verification_email', $email);
        return redirect()->route('user.password.reset', $token);
    }
}
