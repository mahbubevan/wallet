<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;


class NotificationController extends Controller
{
 
     public function notification()
     {
         $notifications = Notification::all();
         return view('admin.control.notification')->with([
             'notifications' => $notifications,
         ]);
     }

     public function make_reverse(Notification $notification)
     {
        // dd($notification->description);
        if($notification->seen==0)
        {
            $notification->seen = 1;
        }else{
            $notification->seen = 0;
        }
        
        $notification->save();

        return redirect()->back()->with('success','Updated Successfully');
     }


}
