<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Course;
use App\Courseexam;
use App\Examquestion;
use Hash;

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

    public function getCourses($softtoken)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $courses = Course::select('id', 'name')
                             ->where('status', 1) // take only active courses
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

    public function getCourseExamQuestions($softtoken, $id)
    {
        if($softtoken == 'Rifat.Admin.2022')
        {
            $examquestions = Examquestion::select('exam_id', 'question_id')
                                     ->where('exam_id', $id)
                                     ->get();

            foreach($examquestions as $examquestion) {
                $examquestion->question = $examquestion->question->select('question');
            }

            return response()->json([
                'success' => true,
                'examquestions' => $examquestions,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
