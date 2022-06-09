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
}
