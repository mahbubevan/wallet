<?php

namespace App\Http\Controllers\Auth;

use App\Charge;
use App\Http\Controllers\Controller;
use App\MasterTransaction;
use App\Notification;
use App\Profile;
use App\Providers\RouteServiceProvider;
use App\ReferralTransaction;
use App\User;
use App\Wallet;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // public function showRegistrationForm()
    // {
    //     // dd($username);
    //     return view('user.auth.register');
    // }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data['email']);
        $ON_SIGNUP_BONUS = Charge::all()->first()->on_signup_bonus;
        // dd($ON_SIGNUP_BONUS);
        $ON_SIGNUP_REF_BONUS = Charge::all()->first()->on_signup_ref_bonus;
        $email = $data['email'];
        $arr = explode('@', $email);
        $length = strlen($arr[0]);
        $make_username = $arr[0] . Str::random($length);

        // dd(if($data['reference_by']!=null));
        if($data['reference_by']!=null){
            if(User::where('username',$data['reference_by'])->count()!=1){
                $data['reference_by'] = null;
            }else{
                $ref_id = User::where('username',$data['reference_by'])->first()->id;
                $data['reference_by'] = $ref_id;
                // dd($ref_id);
                $refer_wallet = Wallet::where('user_id',$ref_id)->first();
                $refer_current_balance = $refer_wallet->current_balance;
                // dd($refer_current_balance);
                $refer_current_update_balance = $refer_current_balance + $ON_SIGNUP_REF_BONUS;
                // dd($refer_current_update_balance);
                $refer_prev_update_balance = $refer_current_balance;

                // Referrar Wallet Update
                $refer_wallet->current_balance = $refer_current_update_balance;
                $refer_wallet->prev_balance = $refer_prev_update_balance;
                $refer_wallet->save();
            }
        }
  
        $new_user = new User();
        $new_user->name = $data['name'];
        $new_user->username = $make_username;
        $new_user->referenced_by = $data['reference_by'];
        $new_user->email = $data['email'];
        $new_user->password = Hash::make($data['password']);
        $new_user->save();


        $user = User::where('username',$make_username)->first();

        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->current_balance = $ON_SIGNUP_BONUS;
        $wallet->prev_balance = Wallet::PREV_BALANCE;
        $wallet->save();

        if($data['reference_by']!=null)
        {
            $trax_id = $refer_wallet->user->username.Str::random(8).$user->username;   
         
            $referral_transaction = new ReferralTransaction();
            $referral_transaction->user_id = $ref_id;
            $referral_transaction->trax_id = $trax_id;
            $referral_transaction->transaction_by = $user->id;
            $referral_transaction->bonus_amount = $ON_SIGNUP_REF_BONUS;
            $referral_transaction->status = ReferralTransaction::ON_SIGNUP_STATUS;
            $referral_transaction->save();
            

            $master_transaction = new MasterTransaction();
            $master_transaction->user_id = $ref_id;
            $master_transaction->trax_id = $trax_id;
            $master_transaction->amount = $ON_SIGNUP_REF_BONUS;
            $master_transaction->charge = 0;
            $master_transaction->current_balance = $refer_current_update_balance;
            $master_transaction->remarks = "Sign up referral bonus";
            $master_transaction->status = MasterTransaction::CREDITED;
            $master_transaction->save();

        }

      
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->save();
        
        $user_trax = $user->username.Str::random(8);
       
            $master_transaction = new MasterTransaction();
            $master_transaction->user_id = $user->id;
            $master_transaction->trax_id = $user_trax;
            $master_transaction->amount = $ON_SIGNUP_BONUS;
            $master_transaction->charge = 0;
            $master_transaction->current_balance = $user->wallet->current_balance;
            $master_transaction->remarks = "Sign up bonus";
            $master_transaction->status = MasterTransaction::CREDITED;
            $master_transaction->save();
        
       
        Notification::create([
            'description' => "<div><h3>Title: New Registration</h3></div><div><h5>Name:<span class='text-primary'> $user->name</span></h5></div><div><h5>Sign Up Bonus:<span class='text-info'> $ON_SIGNUP_BONUS</span></h5></div><div><h5>Transaction ID:<span class='text-success'> $user_trax</span></h5></div>",
        ]);

        return $new_user;
    }

   

    public function showRegistrationForm($username=null)
    {
        return view('user.auth.register')->with(['username'=>$username]);
    }

    public function register(Request $request)
    {
        if($request->has('reference_by'))
        {
            if($request->reference_by !=null)
            {
                if(User::where('username',$request->reference_by)->count()!=1){
                    return redirect()->back()->with('no_ref','Reference name is not valid. You can sign up without reference');
                }
            }
        }else{
            $request['reference_by'] = null;
        }
      

        // $request['reference_by'] = 'default';
        
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}
