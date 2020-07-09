<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\AdminPasswordReset;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $user = Admin::where('email',$email)->first();

        if(!$user)
        {
            return redirect()->back()->with('message','Invalid User');
        }

        AdminPasswordReset::where('email',$user->email)->delete();
        $token = Str::random(20);
        AdminPasswordReset::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $email = $user->email;
        $sender_email = 'support@wallet.com';
        $headers = "From: <$sender_email> \r\n";
        $headers .= "Content-Type:text/html; charset=utf-8\r\n";
        $msg = "<h2>Your verification code is <span style='color:green;'>$token</span><h2>";

        mail($email,'Password Reset Code',$msg,$headers);

        return view('admin.auth.verify',compact('email'));
    }

    public function verify_token(Request $request)
    {
        $token = $request->verification_code;
        $email = $request->email;
        // $request->validate(['code' => 'required', 'email' => 'required']);
        if (AdminPasswordReset::where('token', $token)->where('email', $email)->count() != 1) {
            return redirect()->route('admin.password.request')->with('message','Invalid Token');
        }
        session()->flash('verification_email', $email);
        return redirect()->route('admin.password.reset', $token);
    }

}
