<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

use Carbon\Carbon;
use DB;
// use Hash;
// use Auth;
// use Image;
// use File;
// use Session;
// use Artisan;
use Redirect;
// use OneSignal;
// use Cache;

class MaterialController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(['admin'])->only('storeQuestionsTopic', 'storeQuestionsTag', 'deleteQuestion');
        // $this->middleware(['manager'])->only();
    }

    public function getQuestions()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $totalquestions = Question::count();
        $questions = Question::orderBy('id', 'desc')->paginate(10);
        $topics = Topic::orderBy('id', 'asc')->get();
        $tags = Tag::orderBy('id', 'asc')->get();

        return view('dashboard.questions.index')
                    ->withQuestions($questions)
                    ->withTopics($topics)
                    ->withTags($tags)
                    ->withTotalquestions($totalquestions);
    }
}
