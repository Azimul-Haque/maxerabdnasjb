<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function test()
    {
        return json_encode("{name: 'Rifat', phone: '01*********'}");
    }
}
