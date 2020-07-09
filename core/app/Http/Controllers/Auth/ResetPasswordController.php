<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request,$token=null)
    {
        $email = session('verification_email');

        if(PasswordReset::where('token',$token)->where('email',$email)->count()!=1)
        {
            return redirect()->route('user.password.request');
        }

        return view('user.auth.passwords.reset')->with([
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
        $user = User::where('email',$request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.login')->with('message','Successfully updated');
    }
}
