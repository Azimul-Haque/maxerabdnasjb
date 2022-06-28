<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Topic;
use App\Exam;
use App\Examcategory;
use App\Examquestion;
use App\Question;
use App\Course;
use App\Courseexam;

use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
use OneSignal;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('clear');
        $this->middleware(['admin'])->only('getExams');
    }

    public function getCourses()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $courses = Course::orderBy('id', 'desc')->paginate(10);
        $totalcourses = Course::count();
        // $examcategories = Examcategory::all();

        return view('dashboard.courses.index')
                    ->withCourses($courses)
                    ->withTotalcourses($totalcourses);
    }

    public function storeCourse(Request $request)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'name'   => 'required|string|max:191',
            'status' => 'required',
        ));

        $course = new Course;
        $course->name = $request->name;
        $course->status = $request->status;
        $course->save();

        Session::flash('success', 'Courses created successfully!');
        return redirect()->route('dashboard.courses');
    }
    
    public function updateCourse(Request $request, $id)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'name'   => 'required|string|max:191',
            'status' => 'required',
        ));

        $course = new Course;
        $course->name = $request->name;
        $course->status = $request->status;
        $course->save();

        Session::flash('success', 'Courses created successfully!');
        return redirect()->route('dashboard.courses');
    }
}
