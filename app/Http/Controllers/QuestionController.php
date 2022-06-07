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
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        // $questions = Questions::paginate(10);
        // $topics = Topic::all();

        // return view('dashboard.questions.index')
        //             ->withUsers($questions)
        //             ->withBalances($topics)
        //             ->withTotalbalance($totalbalance)
        //             ->withTotalexpense($totalexpense);
    }
}
