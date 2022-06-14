<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;

class APIController extends Controller
{
    public function test()
    {
         dd('name');
    }

    public function addUser(Request $request)
    {
        $this->validate($request,array(
            'uid'         => 'required|max:255',
            'name'        => 'required|max:255',
            'mobile'      => 'required|max:255',
            'softtoken'   => 'required|max:255'
        ));


        if($request->softtoken == 'Rifat.Admin.2022') {
            $user = new User;
            $user->uid = $request->uid;
            $user->name = $request->name;
            $user->role = 'user';
            $user->mobile = substr($request->mobile, -11);
            $user->password = Hash::make('12345678');
            $user->save();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
        
    }
}
