<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('clear');
        $this->middleware(['admin'])->only('getUsers', 'storeUser', 'updateUser', 'deleteUser', 'deleteBalance', 'getCreditors', 'getSingleCreditor', 'getAddDuePage', 'deleteCreditorDue', 'getSiteCategorywise');

    }
}
