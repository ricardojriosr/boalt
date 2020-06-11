<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Trait for Validations
use App\User; // Trait to work with Users Model
use Illuminate\Support\Facades\Auth; // Trait for Authentication purposes
use Illuminate\Support\Facades\Http; // For External API purposes

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
            // Get all the erros message in an Array to show them
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
        // Validate the values to login the user
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            // If Fails show the errors in Json
            $errors = $validator->errors();
            $errorsArray = array();
            // Get all the erros message in an Array to show them
            foreach ($errors->all() as $message) {
                $errorsArray[] = $message;
            }
            return response()->json([
                "errors" => $errorsArray
            ], 400);
        } else {

            $remember = true;
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                // Correct Credentials
                if (Auth::check()) {
                    $user = Auth::user();
                    return response()->json([
                        "message" => "Logged In",
                        "user_id" => $user->id
                    ], 200);
                }
            } else {
                // Wrong Password
                return response()->json([
                    "errors" => "Wrong Credentials"
                ], 400);
            }

        }
    }

    /*
    Function to show User Info VIA API
    */
    public function api_user_info()  {
        if (Auth::check()) {
            $userId = Auth::id();
            return response()->json([
                "user_id" => $userId
            ], 200);
        } else {
            // Wrong Password
            return response()->json([
                "errors" => "No user logged in"
            ], 400);
        }
    }

    public function api_yelp_info(Request $request) {
        $clientId = env('YELP_CLIENT_ID'); //Data pulled from .env file
        $appKey =  env('YELP_API_KEY'); //Data pulled from .env file
        $yelpApiEndpoint = "https://api.yelp.com/v3/businesses/" . $request->business_id;
        $response = Http::withHeaders([
            'authorization' => 'Bearer '. $appKey
        ])->get($yelpApiEndpoint)->json();
        return $response;
    }


}
