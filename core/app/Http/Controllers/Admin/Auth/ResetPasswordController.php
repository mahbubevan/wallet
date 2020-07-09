<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\AdminPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function showResetForm(Request $request,$token=null)
    {
        $email = session('verification_email');

        if(AdminPasswordReset::where('token',$token)->where('email',$email)->count()!=1)
        {
            return redirect()->route('admin.password.request')->with('message','Invalid Token');
        }

        return view('admin.auth.passwords.reset')->with([
            'email' => $email,
            'token' => $token
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails())
        {
            session()->flash('verification_email', $request->email);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Admin::where('email',$request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.login')->with('message','Successfully updated');
    }
}
