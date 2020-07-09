<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Notification;
use App\Profile;
use App\ReferralTransaction;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Charge::all()->first()->set_currency;

        $user = auth()->user();
        // dd($user);
        $transactions = $user->master_transactions()->orderBy('created_at','desc')->paginate(10,['*'],'transaction');
        return view('user.profile')->with([
            'user' => $user,
            'transactions' => $transactions,
            'currency' => $currency,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        // dd($profile);
        // dd($profile->id);
        if(auth()->user()->id==$profile->user->id)
        {
            return view('user.profile_edit')->with([
                'profile' => $profile
            ]);
        }

        return abort(403, 'Unauthorized action.');
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        if(!auth()->user()->id==$profile->user->id)
        {
          return abort(403,'Unauthorized');  
        }
      
        $profile->address = $request->address;
        $profile->city = $request->city;
        $profile->zip = $request->zip;
        $profile->nid = $request->nid;
        //    dd($profile_up);
        // dd($request->has('img'));
        if ($request->has('img')) {

            $validator = Validator::make($request->all(), [
                'img' => 'mimes:jpeg,png | max:1000',
            ]);

            
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $file = $request->file('img');
            $dateTime = date('Ymd_His');
            $filename = '/assets/img/' . $dateTime . '-' . $file->getClientOriginalName();
            $savePath = 'assets/img/';

            $data['img'] = $filename;
            $profile->img = $data['img'];
            // dd($profile_up);
            $profile->save();
            $file->move($savePath, $filename);
            
        }else{
            $profile->save();
        }
        // dd($profile_up);
        // $user->save();
    //    $profile_up->save();
            $name = $profile->user->name;
            Notification::create([
                'description' => "<div><h3>Title: Profile Update</h3></div><div><h5>Name:<span class='text-info'> $name</span></h5></div>",
            ]);
        
        
        return redirect()->back()->with(['message'=>'Successfully updated']);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
