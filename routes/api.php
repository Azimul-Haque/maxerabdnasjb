<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testapi', 'APIController@test')->name('api.test');

Route::get('/checkuid/{softtoken}/{phonenumber}', 'APIController@checkUid')->name('api.checkuid');
Route::get('/checkpackagevalidity/{softtoken}/{uid}', 'APIController@checkPackageValidity')->name('api.checkpackagevalidity');
Route::post('/adduser', 'APIController@addUser')->name('api.adduser');
Route::post('/updateuser', 'APIController@updateUser')->name('api.updateuser');

Route::get('/getcourses/{softtoken}/{coursetype}', 'APIController@getCourses')->name('api.getcourses');
Route::get('/getcourses/exams/{softtoken}/{id}', 'APIController@getCourseExams')->name('api.getcourses.exams');
Route::get('/getothercourses/exams/{softtoken}/{coursetype}', 'APIController@getOtherCourseExams')->name('api.getothercourses.exams');
Route::get('/getcourses/exam/{softtoken}/{id}/questions', 'APIController@getCourseExamQuestions')->name('api.getcourses.exam.questions');
Route::get('/gettopics/{softtoken}', 'APIController@getTopics')->name('api.gettopics');
Route::get('/getpackages/{softtoken}', 'APIController@getPackages')->name('api.getpackages');
Route::post('/payment/proceed', 'APIController@paymentProceed')->name('api.paymentproceed');
