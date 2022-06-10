<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exam;
use App\Examcategory;
use App\Examquestion;
use App\Question;

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
            'examcategory_id'    => 'required|string|max:191',
            'name'               => 'required|string|max:191',
            'duration'           => 'required|string|max:191',
            'qsweight'           => 'required|string|max:191',
            'negativepercentage' => 'required|string|max:191',
            'price_type'         => 'required|string|max:191',
            'available_from'     => 'required|string|max:191',
            'available_to'       => 'required|string|max:191',
        ));

        $exam = new Exam;
        $exam->examcategory_id = $request->examcategory_id;
        $exam->name = $request->name;
        $exam->duration = $request->duration;
        $exam->qsweight = $request->qsweight;
        $exam->negativepercentage = $request->negativepercentage;
        $exam->price_type = $request->price_type;
        $exam->available_from = Carbon::parse($request->available_from);
        $exam->available_to = Carbon::parse($request->available_to);
        $exam->save();

        Session::flash('success', 'Exam created successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function updateExam(Request $request, $id)
    {
        // dd($request->file('image'));
        // dd($request->file('image'));
        $this->validate($request,array(
            'examcategory_id'    => 'required|string|max:191',
            'name'               => 'required|string|max:191',
            'duration'           => 'required|string|max:191',
            'qsweight'           => 'required|string|max:191',
            'negativepercentage' => 'required|string|max:191',
            'price_type'         => 'required|string|max:191',
            'available_from'     => 'required|string|max:191',
            'available_to'       => 'required|string|max:191',
        ));

        $exam = Exam::find($id);
        $exam->examcategory_id = $request->examcategory_id;
        $exam->name = $request->name;
        $exam->duration = $request->duration;
        $exam->qsweight = $request->qsweight;
        $exam->negativepercentage = $request->negativepercentage;
        $exam->price_type = $request->price_type;
        $exam->available_from = Carbon::parse($request->available_from);
        $exam->available_to = Carbon::parse($request->available_to);
        $exam->save();

        Session::flash('success', 'Exam updated successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function deleteExam($id)
    {
        $exam = Exam::findOrFail($id);
        // kaaj ache aro
        // kaaj ache aro
        // kaaj ache aro
        $exam->delete();

        Session::flash('success', 'Exam deleted successfully!');
        return redirect()->route('dashboard.exams');
    }

    public function addQuestionToExam($id)
    {
        $exam = Exam::findOrFail($id);
        $examquestions = Examquestion::where('exam_id', $exam->id)->get();
        $questions = Question::all();
        
        return view('dashboard.exams.addquestion')
                                    ->withExam($exam)
                                    ->withExamquestions($examquestions)
                                    ->withQuestions($questions);
    }

    public function storeExamQuestion(Request $request)
    {
        $this->validate($request,array(
            'exam_id'          => 'required',
            'hiddencheckarray' => 'required',
            'questioncheck'    => 'required',
        ));

        $hiddencheckarray = explode(',', $request->hiddencheckarray);

        foreach($hiddencheckarray as $question_id) {
            $examquestion = new Examquestion;
            $examquestion->exam_id = $request->exam_id;
            $examquestion->question_id = $question_id;
            $examquestion->save();
        }
        
        Session::flash('success', 'Topic created successfully!');
        return redirect()->route('dashboard.exams');
    }
}
