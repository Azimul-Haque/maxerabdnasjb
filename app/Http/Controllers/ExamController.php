<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exam;
use App\Examcategory;

use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
use OneSignal;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('clear');
        $this->middleware(['admin'])->only('getQuestions');
    }

    public function getExams()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $exams = Exam::paginate(10);
        $examcategories = Examcategory::all();

        return view('dashboard.exams.index')
                    ->withExams($exams)
                    ->withExamcategories($examcategories);
    }

    public function storeExamCategory(Request $request)
    {
        $this->validate($request,array(
            'name'        => 'required|string|max:191',
        ));

        $category = new Examcategory;
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Topic created successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function updateExamCategory(Request $request, $id)
    {
        $this->validate($request,array(
            'name' => 'required|string|max:191',
        ));

        $category = Examcategory::find($id);;
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Category updated successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function deleteQuestionsTopic($id)
    {
        $category = Examcategory::find($id);
        $category->delete();

        Session::flash('success', 'Category deleted successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function storeExam(Request $request)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'topic_id'    => 'required|string|max:191',
            'question'    => 'required|string|max:191',
            'answer'      => 'required|string|max:191',
            'option1'     => 'required|string|max:191',
            'option2'     => 'required|string|max:191',
            'option3'     => 'required|string|max:191',
            'difficulty'  => 'required|string|max:191',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'explanation' => 'sometimes|max:2048',
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
            $filename   = random_string(5) . time() .'.' . "webp";
            $location   = public_path('images/questions/'. $filename);
            Image::make($image)->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $questionimage = new Questionimage;
            $questionimage->question_id = $question->id;
            $questionimage->image = $filename;
            $questionimage->save();
        }

        if($request->explanation) {
            $questionexplanation = new Questionexplanation;
            $questionexplanation->question_id = $question->id;
            $questionexplanation->explanation = $request->explanation;
            $questionexplanation->save();
        }

        Session::flash('success', 'Question created successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function updateExam(Request $request, $id)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'topic_id'    => 'required|string|max:191',
            'question'    => 'required|string|max:191',
            'answer'      => 'required|string|max:191',
            'option1'     => 'required|string|max:191',
            'option2'     => 'required|string|max:191',
            'option3'     => 'required|string|max:191',
            'difficulty'  => 'required|string|max:191',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'explanation' => 'sometimes|max:2048',
        ));

        $question = Question::findOrFail($id);
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
        return redirect()->route('dashboard.exams');
    }

    public function deleteExam($id)
    {
        $question = Question::find($id);
        if($question->questionimage) {
            $image_path = public_path('images/questions/'. $question->questionimage->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $question->questionimage->delete();
        }
        $question->questionexplanation->delete();
        $question->delete();

        Session::flash('success', 'Question deleted successfully!');
        return redirect()->route('dashboard.exams');
    }
}
