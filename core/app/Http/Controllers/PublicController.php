<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function store_email(Request $request)
    {
        // return response()->json(['data'=>'ok']);
        $validator = Validator::make($request->all(),[
            'name' => 'bail|string|min:3',
             'from' => 'email',
            'subject' => 'max:12',
            'body' => 'max:140'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        // $this->validate($request,[
        //     'name' => 'string|min:3',
        //     'from' => 'email',
        //     'subject' => 'max:12',
        //     'body' => 'max:140'
        // ]);
        // return "ok";

        Email::create([
            'name' => $request->name,
            'from' => $request->from,
            'subject' => $request->subject,
            'body' => $request->body
        ]);

        return response()->json(['message'=>'Successfully Sent']);

    }
}
