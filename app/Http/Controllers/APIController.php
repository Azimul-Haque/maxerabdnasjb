<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Course;
use App\Courseexam;
use App\Examquestion;
use App\Topic;
use App\Package;
use App\Temppayment;
use Hash;
use Carbon\Carbon;

class APIController extends Controller
{
    public function test()
    {
         dd('name');
    }

    public function checkUid($softtoken, $uid)
    {
        $user = User::where('uid', $uid)->first();

        if($user && $softtoken == 'Rifat.Admin.2022')
        {
            return response()->json([
                'success' => true,
                'uid' => $user->uid,
                'name' => $user->name,
                'mobile' => $user->mobile,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function checkPackageValidity($softtoken, $uid)
    {
        $user = User::where('uid', $uid)->first();

        if($user && $softtoken == 'Rifat.Admin.2022')
        {
            return response()->json([
                'success' => true,
                'package_expiry_date' => date('Y-m-d H:i:s', strtotime($user->package_expiry_date)),
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function addUser(Request $request)
    {
        $this->validate($request,array(
            'uid'         => 'required|max:255|unique:users,uid',
            'name'        => 'required|max:255',
            'mobile'      => 'required|max:255',
            'softtoken'   => 'required|max:255'
        ));

        if($request->softtoken == 'Rifat.Admin.2022')
        {
            $user = new User;
            $user->uid = $request->uid;
            $package_expiry_date = Carbon::now()->addDays(1)->format('Y-m-d') . ' 23:59:59';
            // dd($package_expiry_date);
            $user->package_expiry_date = $package_expiry_date;
            $user->name = $request->name;
            $user->role = 'user';
            $user->mobile = substr($request->mobile, -11);
            $user->password = Hash::make('12345678');
            $user->save();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    public function updateUser(Request $request)
    {
        $this->validate($request,array(
            'uid'         => 'required',
            'name'        => 'required|max:255',
            'softtoken'   => 'required|max:255'
        ));

        $user = User::where('uid', $request->uid)->first();

        if($user && $request->softtoken == 'Rifat.Admin.2022')
        {
            $user->name = $request->name;
            $user->save();

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getCourses($softtoken, $coursetype)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $courses = Course::select('id', 'name')
                             ->where('status', 1) // take only active courses
                             ->where('type', $coursetype) // 1 = Course, 2 = BJS MT, 3 = Bar MT, 4 = Free MT, 5 = QB
                             ->get();

            return response()->json([
                'success' => true,
                'courses' => $courses,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getCourseExams($softtoken, $id)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $courseexams = Courseexam::select('course_id', 'exam_id')
                                     ->where('course_id', $id)
                                     ->get();

            foreach($courseexams as $courseexam) {
                $courseexam->name = $courseexam->exam->name;
            }

            return response()->json([
                'success' => true,
                'exams' => $courseexams,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getOtherCourseExams($softtoken, $coursetype)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $course = Course::select('id')
                             ->where('status', 1) // take only active courses
                             ->where('type', $coursetype) // 1 = Course, 2 = BJS MT, 3 = Bar MT, 4 = Free MT, 5 = QB
                             ->first(); 

            $courseexams = Courseexam::select('course_id', 'exam_id')
                                     ->where('course_id', $course->id)
                                     ->get();

            foreach($courseexams as $courseexam) {
                $courseexam->name = $courseexam->exam->name;
            }

            return response()->json([
                'success' => true,
                'exams' => $courseexams,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getCourseExamQuestions($softtoken, $id)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $examquestions = Examquestion::select('exam_id', 'question_id')
                                     ->where('exam_id', $id)
                                     ->get();

            foreach($examquestions as $examquestion) {
                $examquestion->question = $examquestion->question->makeHidden(['id', 'topic_id', 'difficulty', 'created_at', 'updated_at']);
            }

            return response()->json([
                'success' => true,
                'questions' => $examquestions,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getTopics($softtoken)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $topics = Topic::all();

            return response()->json([
                'success' => true,
                'topics' => $topics,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getPackages($softtoken)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $packages = Package::select('id', 'name', 'tagline', 'duration', 'price', 'strike_price', 'suggested')
                               ->where('status', 1)->get();

            return response()->json([
                'success' => true,
                'packages' => $packages,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function paymentProceed(Request $request)
    {
        $this->validate($request,array(
            'user_number'    =>   'required',
            'package_id'     =>   'required',
            'amount'         =>   'required',
            'trx_id'         =>   'required',
        ));

        $user = User::where('mobile', $request->user_number)->first();
        $package = Package::findOrFail($request->package_id);

        if($request->softtoken == 'Rifat.Admin.2022') {
            if($user) {
                $temppayment = new Temppayment;
                $temppayment->user_id = $user->id;
                $temppayment->package_id = $request->package_id;
                $temppayment->uid = $user->uid;
                // generate Trx_id
                $trx_id = $request->trx_id;
                $temppayment->trx_id = $request->trx_id;
                $temppayment->amount = $request->amount;
                $temppayment->save();

                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false
                ]);
            }
        } else {
            return response()->json([
                'success' => false
            ]);
        }
        
    }
}
