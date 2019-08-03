<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;


class CheckIfAdmin
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
        // Method one
        if(Auth::check() && Auth::user()->user_type_id == 2)
        {
            if (Auth::user()->user_type_id == 1) 
            {
				return route('admin.dashboard');
            } 
            else 
            {
				return $next($request);
			}
        }
        
        /*Method two
            $user=Auth::user();
            dd('$user');

            if($user){
                $role=UserType::whereUser_Type_Id(1)->first();
                if($user->)
            }
        */
    }
}
