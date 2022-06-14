<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function test()
    {
         dd('name');
    }

    public function addUser(Request $request)
    {
        $this->validate($request,array(
            'name'        => 'required|max:255',
            'email'       => 'required|max:255',
            'message'     => 'required|max:255'
        ));

        $message = new Charioteermessage;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

        return response()->json([
            'success' => true
        ]);
    }
}
