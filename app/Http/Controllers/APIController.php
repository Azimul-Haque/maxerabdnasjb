<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class APIController extends Controller
{
    public function test()
    {
         dd('name');
    }

    public function addUser(Request $request)
    {
        $this->validate($request,array(
            'uid'      => 'required|max:255',
            'name'     => 'required|max:255',
            'mobile'   => 'required|max:255'
        ));

        $user = new User;
        $user->uid = $request->uid;
        $user->name = $request->name != null ? $request->name : 'No Name';
        $user->mobile = $request->mobile;
        $user->role = 'user';
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true
        ]);
    }
}
