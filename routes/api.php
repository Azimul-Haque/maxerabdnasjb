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

Route::get('/checkuid/{softtoken}/{uid}', 'APIController@checkUid')->name('api.checkuid');
Route::post('/adduser', 'APIController@addUser')->name('api.adduser');
Route::post('/updateuser', 'APIController@addUser')->name('api.adduser');
