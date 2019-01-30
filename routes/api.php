<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('user/register', 'APIRegisterController@register')->middleware('cors');
Route::post('user/register', ['middleware' => 'cors','uses' => 'APIRegisterController@register']);
Route::post('user/login', 'APILoginController@login');

Route::post('questions/create', ['middleware' => ['jwt.auth','cors'],'uses' => 'QuestionController@store']);
Route::get('questions', ['middleware' =>  ['jwt.auth','cors'],'uses' => 'QuestionController@index']);
// Route::get('questions/{id}', ['middleware' =>  ['jwt.auth','cors'],'uses' => 'QuestionController@getQuestion']);
Route::post('question', ['middleware' =>  ['cors','jwt.auth'],'uses' => 'QuestionController@getQuestion']);

Route::post('answer', ['middleware' =>  ['jwt.auth','cors'],'uses' => 'AnswerController@getAnswer']);
// Route::get('test', ['middleware' =>  ['jwt.auth','cors'],'uses' => 'UserController@create']);
Route::post('answer/submit', ['middleware' =>  ['jwt.auth','cors'],'uses' => 'AnswerController@store']);


Route::get('getusers',['middleware' => ['jwt.auth','cors'],'uses' =>'UserController@index']);

Route::middleware('jwt.auth','cors')->get('users', function(Request $request) {
    return auth()->user();
});
// Route::middleware('jwt.auth')->get('getusers','UserController@index');