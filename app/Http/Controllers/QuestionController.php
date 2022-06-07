<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Topic;

use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
use OneSignal;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('clear');
        $this->middleware(['admin'])->only('getQuestions', 'storeQuestionsTopic');
    }

    public function getQuestions()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $questions = Question::paginate(10);
        $topics = Topic::all();

        return view('dashboard.questions.index')
                    ->withQuestions($questions)
                    ->withTopics($topics);
    }

    public function storeQuestionsTopic(Request $request)
    {
        $this->validate($request,array(
            'name'        => 'required|string|max:191',
        ));

        $topic = new Topic;
        $topic->name = $request->name;
        $topic->save();

        Session::flash('success', 'User created successfully!');
        return redirect()->route('dashboard.questions');
    }
}
