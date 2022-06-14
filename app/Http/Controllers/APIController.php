<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function test()
    {
        return json_decode([{'name': 'Rifat', 'phone': '01*********'}]);
    }
}
