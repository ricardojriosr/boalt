<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Trait for Validations
use App\Notification; // Model for notifications

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the values to login the user
        $validator = Validator::make($request->all(), [
            'notification' => 'required|string|max:255'
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
            if(!isset($_SESSION)) { session_start(); } // Start the sessions if not started
            if (isset($_SESSION['api_user_id'])) { // CHeck if the user id exists in the session
                $notification = new Notification(); // Create new notification
                $notification->notification = $request->notification;
                $notification->user_id = $_SESSION['api_user_id'];
                $notification->read = 0;
                $notification->save();
                return response()->json([
                    "message" => 'Notification was sent'
                ], 200);
            } else {
                return response()->json([
                    "errors" => 'You must log in'
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (isset($_SESSION['api_user_id'])) { // CHeck if the user id exists in the session
            if(!isset($_SESSION)) { session_start(); } // Start the sessions if not started
            $notifications = Notification::where('user_id','=',$_SESSION['api_user_id'])->get();
            return response()->json([
                "notifications" => $notifications
            ], 200);
        } else {
            return response()->json([
                "errors" => 'You must log in'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request)
    {
        // Validate the values to login the user
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|numeric'
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
            $readable = 'Read';
            $notification = Notification::find($request->notification_id);
            if ($notification->read == 0) {
                $notification->read = 1;
            } else {
                $notification->read = 0;
                $readable = 'Unread';
            }
            $notification->save();
            return response()->json([
                "message" => "The message with ID # " . $request->notification_id . " was updated to " . $readable
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // Delete all records

    }
}
