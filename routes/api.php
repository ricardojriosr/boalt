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

Route::post('user/login', 'userDataRestController@api_user_login'); // Route for User Login in API
Route::post('user/register', 'userDataRestController@api_user_register'); // Route for User Registration in API


Route::get('user/info', 'userDataRestController@api_user_info');
Route::post('yelp/api', 'userDataRestController@api_yelp_info');

// Protected Routes, must be logged in
/*
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'userDataRestController@api_user_info');
});
*/


