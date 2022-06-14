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

        // PURAN PAPI CHECK HOBE...
        // PURAN PAPI CHECK HOBE...
        // PURAN PAPI CHECK HOBE...
        $user = new User;
        $user->uid = $request->uid;
        $user->name = $request->name;
        $user->role = 'user';
        $user->mobile = $request->mobile;
        $user->password = Hash::make('12345678');
        $user->save();

        return response()->json([
            'success' => true
        ]);
    }
}
