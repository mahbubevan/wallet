<?php

namespace App\Http\Controllers\Admin;

use App\Email;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::all();

        return view('admin.control.email')->with([
            'emails' => $emails
        ]);
    }

    public function make_reverse(Email $email)
    {
       // dd($notification->description);
       if($email->status==0)
       {
           $email->status = 1;
       }else{
           $email->status = 0;
       }
       
       $email->save();

       return redirect()->back()->with('success','Updated Successfully');
    }

}
