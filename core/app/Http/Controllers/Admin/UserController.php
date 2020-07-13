<?php

namespace App\Http\Controllers\Admin;

use App\Charge;
use App\Http\Controllers\Controller;
use App\InterestTransaction;
use App\MasterTransaction;
use App\Profile;
use App\ReferralTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $users = User::with('profile','wallet','referred_by')->paginate(10,['*'],'user_page');
        return view('admin.user.userlist')->with([
            'users' => $users,
        ]);
    }

    public function show(Profile $profile)
    {
        $current_balance = $profile->user->wallet->current_balance;
        // dd($current_balance);
        $user_id = $profile->user->id;

        // $transaction_count = MasterTransaction::where('user_id',$user_id)->count();

        $total_send_balance = MasterTransaction::where('status',MasterTransaction::DEBITED)->where('user_id',$user_id)->sum('amount');
        $total_rcv_balance = MasterTransaction::where('status',MasterTransaction::CREDITED)->where('user_id',$user_id)->sum('amount');

        // $current_balance = auth()->user()->wallet->current_balance;

        $total_referral_user = User::where('referenced_by',$user_id)->count();
        $total_referral_bonus = ReferralTransaction::where('user_id',$user_id)->sum('bonus_amount');

        $bonus = InterestTransaction::where('user_id',$user_id)->sum('amount');

        $currency = Charge::first(['set_currency'])->set_currency;

        return view('admin.user.profile')->with([
            'profile' => $profile,
            'current_balance' => $current_balance,
            'currency' => $currency,
            'bonus' => $bonus,
            'total_send_balance' => $total_send_balance,
            'total_rcv_balance' => $total_rcv_balance,
            'total_ref_user' => $total_referral_user,
            'total_ref_bonus' => $total_referral_bonus
        ]);
    }

    public function update(Request $request,Profile $profile)
    {
        // dd($request->all());
        $user = $profile->user;
        $wallet = $user->wallet;

        if($user->username!=$request->username){
            $validator = Validator::make($request->all(),[
                        'username' => 'required | unique:users',
                    ]);
            
                    if($validator->fails()){
                        return redirect()->back()
                                        ->withErrors($validator)
                                        ->withInput();
                    }
            
                    $user->username = $request->username;
                    
        }

        if($user->email!=$request->email){
            $validator = Validator::make($request->all(),[
                        'email' => 'required | unique:users',
                    ]);
            
                    if($validator->fails()){
                        return redirect()->back()
                                        ->withErrors($validator)
                                        ->withInput();
                    }
            
                    $user->email = $request->email;
        }

        $user->name = $request->name;

        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->zip = $request->zip;
        $profile->nid = $request->nid;

        if($request->has('img'))
        {
            $validator = Validator::make($request->all(), [
                'img' => 'image:jpeg,png | max:1000',
            ]);

            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            // unlink($profile->img);

            $file = $request->file('img');
            $dateTime = date('Ymd_His');
            $filename = '/assets/img/' . $dateTime . '-' . $file->getClientOriginalName();
            $savePath = 'assets/img/';
            
            // $new_path = ltrim($profile->img,$profile->img[0]);
            // dd($new_path);
            // dd(File::exists($new_path));
            // if(File::exists($new_path))
            // {
            //     unlink($new_path);
            // }

            $data['img'] = $filename;
            $profile->img = $data['img'];
            // dd($profile_up);
            $profile->save();
            $file->move($savePath, $filename);
        }

        $user->save();
        $profile->save();

        return redirect()->back()->with('success','Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // dd($user->delete());
        $user->delete();

        return redirect()->back();
    }
}
