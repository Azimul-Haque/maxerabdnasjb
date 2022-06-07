<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Topic;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('clear');
        $this->middleware(['admin'])->only('getQuestions');
    }

    public function getQuestions()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')) {
            abort(403, 'Access Denied');
        }
        // $users = User::whereNotIn('mobile', ['01751398392', '01837409842'])->get();
        // $totalbalance = Balance::sum('amount');
        // $totalexpense = Expense::sum('amount');

        // $balances = Balance::where('amount', '>', 0)
        //                    ->orderBy('id', 'desc')
        //                    ->paginate(5);

        // return view('dashboard.questions.index')
        //             ->withUsers($users)
        //             ->withBalances($balances)
        //             ->withTotalbalance($totalbalance)
        //             ->withTotalexpense($totalexpense);
    }
}
