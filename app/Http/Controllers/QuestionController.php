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

        Session::flash('success', 'Topic created successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function updateQuestionsTopic(Request $request, $id)
    {
        $this->validate($request,array(
            'name' => 'required|string|max:191',
        ));

        $topic = Topic::find($id);;
        $topic->name = $request->name;
        $topic->save();

        Session::flash('success', 'Topic updated successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function deleteQuestionsTopic($id)
    {
        $topic = Topic::find($id);
        $topic->delete();

        Session::flash('success', 'Topic deleted successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function storeQuestions(Request $request)
    {
        $this->validate($request,array(
            'topic_id'   => 'required|string|max:191',
            'question'   => 'required|string|max:191',
            'answer'     => 'required|string|max:191',
            'option1'    => 'required|string|max:191',
            'option2'    => 'required|string|max:191',
            'option3'    => 'required|string|max:191',
            'difficulty' => 'required|string|max:191',
            'image' => 'sometimes|string|max:191',
            'explanation' => 'sometimes|string|max:191',
        ));

        $question = new Question;
        $question->topic_id = $request->topic_id;
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->difficulty = $request->difficulty;
        $question->save();

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('images/blogs/'. $filename);
            Image::make($image)->resize(600, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $blog->featured_image = $filename;
        }

        Session::flash('success', 'Question created successfully!');
        return redirect()->route('dashboard.questions');
    }
}
