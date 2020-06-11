<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Trait for Validations
use App\User; // Trait t owork with Users

class userDataRestController extends Controller
{
    /*
    Function to Register User VIA API
    */
    public function api_user_register(Request $request)
    {
        // Validate the values to register the new user
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            // If Fails show the errors in Json
            $errors = $validator->errors();
            $errorsArray = array();
            foreach ($errors->all() as $message) {
                $errorsArray[] = $message;
            }
            return response()->json([
                "errors" => $errorsArray
            ], 400);
        } else {
            // If success create the User
            $user = new User();
            $user->name = $request->name; // Generate Fake Name
            $user->email = $request->email; // Generate Fake Name
            $user->password = bcrypt($request->password); // Encrypted password "secret"
            $user->save();
            return response()->json([
                "message" => "User Registered"
            ], 200);
        }
    }

    /*
    Function to Login User VIA API
    */
    public function api_user_login(Request $request)
    {
        return response()->json([
            "message" => "method working"
        ], 200);
    }

}
