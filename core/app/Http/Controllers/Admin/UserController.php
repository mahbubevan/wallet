<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $users = User::paginate(10,['*'],'user_page');
        return view('admin.user.userlist')->with([
            'users' => $users,
        ]);
    }

    public function show(Profile $profile)
    {
        // dd($profile);
        $refers = User::where('referenced_by',$profile->user->id)->get();
        return view('admin.user.profile')->with([
            'profile' => $profile,
            'refers' => $refers,
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

        if($wallet->current_balance != $request->current_balance)
        {
            $wallet->prev_balance = $wallet->current_balance;
            $wallet->current_balance = $request->current_balance;

            $wallet->save();
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
            
            $new_path = ltrim($profile->img,$profile->img[0]);
            // dd($new_path);
            // dd(File::exists($new_path));
            if(File::exists($new_path))
            {
                unlink($new_path);
            }

            $data['img'] = $filename;
            $profile->img = $data['img'];
            // dd($profile_up);
            $profile->save();
            $file->move($savePath, $filename);
        }

        $user->save();
        $profile->save();

        return redirect()->back()->with('message','Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // dd($user->delete());
        $user->delete();

        return redirect()->back();
    }
}
