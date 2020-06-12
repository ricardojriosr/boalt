<?php

namespace App\Http\Middleware;

use Closure;

class AuthSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        * This is the only way I could think quickly to create user login persistency in the API
        */
        if(!isset($_SESSION)) { session_start(); }
        if ((isset($_SESSION['api_user_id'])) && ($_SESSION['api_user_id'] != "")) {
            return $next($request);
        } else {
            return response()->json(["error" => "Not Allowed, must login"], 401);
        }
    }
}
