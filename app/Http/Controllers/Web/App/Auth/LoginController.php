<?php

namespace App\Http\Controllers\Web\App\Auth;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Alert;

class LoginController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function index(){
        $title = 'Login Page';
        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view ('pages.app.login');
    }

    public function detectLogin(Request $request){

        // $request->flash(); //Save Old Input Value
        
            if (Auth::attempt($request->only('email', 'password'))) // Check if Authentication data exists
            {
                if(Auth::user()->is_active == 1) //Check if User is Active
                {
                    if(Auth::user()->user_type_id == 1) //Check if U_type = 1
                    {
                        return redirect()->route('admin.dashboard');
                    }
                    else 
                    {
                        return redirect()->route('user.dashboard');
                    }
                }
                else
                {
                    return redirect()->route('login')->with('error','Your Account Disabled Or Not Activated yet');
                }
            }
            else
            {
                return redirect()->back()->with('warning','Email And Password Did not Match')->withInput();
            }
    }
    
    public function getLogout(){
        
        Auth::logout();

        return redirect()->route('login');
    }
}
