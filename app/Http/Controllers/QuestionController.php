<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Questionimage;
use App\Questionexplanation;
use App\Topic;
use App\Tag;

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
        $this->middleware('auth');
        $this->middleware(['admin'])->only('storeQuestionsTopic', 'deleteQuestion');
    }

    public function getQuestions()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $totalquestions = Question::count();
        $questions = Question::paginate(10);
        $topics = Topic::all();
        $tags = Tag::all();

        return view('dashboard.questions.index')
                    ->withQuestions($questions)
                    ->withTopics($topics)
                    ->withTags($tags)
                    ->withTotalquestions($totalquestions);
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

    public function storeQuestionsTag(Request $request)
    {
        $this->validate($request,array(
            'name'        => 'required|string|max:191|unique:tags,name',
        ));

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'Tag created successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function updateQuestionsTag(Request $request, $id)
    {
        $this->validate($request,array(
            'name' => 'required|string|max:191|unique:tags,name,' . $id,
        ));

        $tag = Tag::find($id);;
        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'Tag updated successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function deleteQuestionsTag($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        Session::flash('success', 'Tag deleted successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function storeQuestion(Request $request)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'topic_id'    => 'required|string|max:191',
            'question'    => 'required|string|max:191',
            'option1'     => 'required|string|max:191',
            'option2'     => 'required|string|max:191',
            'option3'     => 'required|string|max:191',
            'option4'     => 'required|string|max:191',
            'answer'      => 'required',
            'difficulty'  => 'required|string|max:191',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'explanation' => 'sometimes|max:2048',
        ));

        $question             = new Question;
        $question->topic_id   = $request->topic_id;
        $question->question   = $request->question;
        $question->option1    = $request->option1;
        $question->option2    = $request->option2;
        $question->option3    = $request->option3;
        $question->option4    = $request->option4;
        $question->answer     = $request->answer;
        $question->difficulty = $request->difficulty;
        $question->save();

        
        if(isset($request->tags_ids)){
            $question->tags()->sync($request->tags_ids, false);
        }

        // image upload
        if($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = random_string(5) . time() .'.' . "webp";
            $location = public_path('images/questions/'. $filename);
            Image::make($image)->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $questionimage              = new Questionimage;
            $questionimage->question_id = $question->id;
            $questionimage->image       = $filename;
            $questionimage->save();
        }

        if($request->explanation) {
            $questionexplanation              = new Questionexplanation;
            $questionexplanation->question_id = $question->id;
            $questionexplanation->explanation = $request->explanation;
            $questionexplanation->save();
        }

        Session::flash('success', 'Question created successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function updateQuestion(Request $request, $id)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'topic_id'    => 'required|string|max:191',
            'question'    => 'required|string|max:191',
            'option1'     => 'required|string|max:191',
            'option2'     => 'required|string|max:191',
            'option3'     => 'required|string|max:191',
            'option4'     => 'required|string|max:191',
            'answer'      => 'required',
            'difficulty'  => 'required|string|max:191',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'explanation' => 'sometimes|max:2048',
        ));

        // dd($request->tags_ids);

        $question             = Question::findOrFail($id);
        $question->topic_id   = $request->topic_id;
        $question->question   = $request->question;
        $question->option1    = $request->option1;
        $question->option2    = $request->option2;
        $question->option3    = $request->option3;
        $question->option4    = $request->option4;
        $question->answer     = $request->answer;
        $question->difficulty = $request->difficulty;
        $question->save();

        if(isset($request->tags_ids)){
            $question->tags()->sync($request->tags_ids, true);
        }

        // image upload
        if($request->hasFile('image')) {
            if($question->questionimage) {
                $image_path = public_path('images/questions/'. $question->questionimage->image);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $question->questionimage->delete();
            }
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . "webp";
            $location   = public_path('images/questions/'. $filename);
            Image::make($image)->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $questionimage = new Questionimage;
            $questionimage->question_id = $question->id;
            $questionimage->image = $filename;
            $questionimage->save();
        }

        if($request->explanation) {
            if($question->questionexplanation) {
                $question->questionexplanation->explanation = $request->explanation;
                $question->questionexplanation->save();
            } else {
                $questionexplanation = new Questionexplanation;
                $questionexplanation->question_id = $question->id;
                $questionexplanation->explanation = $request->explanation;
                $questionexplanation->save();
            }
        }

        Session::flash('success', 'Question updated successfully!');
        return redirect()->route('dashboard.questions');
    }

    public function deleteQuestion($id)
    {
        $question = Question::find($id);
        if($question->questionimage) {
            $image_path = public_path('images/questions/'. $question->questionimage->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $question->questionimage->delete();
        }
        if($question->questionexplanation) {
            $question->questionexplanation->delete();
        }
        $question->delete();

        Session::flash('success', 'Question deleted successfully!');
        return redirect()->route('dashboard.questions');
    }
}
