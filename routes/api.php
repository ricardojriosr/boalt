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
Route::post('user/logout', 'userDataRestController@api_user_logout'); // Route for User Login in API

// Protected Route(s): for Users Info "must be logged in"
Route::get('user/info', 'userDataRestController@api_user_info')->middleware('AuthSession'); // Route to Grab User Info if logged in

// Protected Route(s): for Yelp API "must be logged in"
Route::post('yelp/api', 'userDataRestController@api_yelp_info')->middleware('AuthSession'); // Route to use External Yelp API

// Protected Route(s): for Notification handling "must be logged in"
Route::post('notification/new', 'NotificationController@store')->middleware('AuthSession'); // Route to Create Notification
Route::get('notification/show', 'NotificationController@show')->middleware('AuthSession'); // Route to Show Notifications
Route::post('notification/update', 'NotificationController@update_status')->middleware('AuthSession'); // Route to Update Read/Unread Notifications






