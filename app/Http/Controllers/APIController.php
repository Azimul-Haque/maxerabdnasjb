<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function test()
    {
         dd(['name': 'Rifat', 'phone': '01*********']);
    }
}
