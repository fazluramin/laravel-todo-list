<?php

namespace App\Http\Controllers\Web\App\Auth;

use App\Models\Users;
use Mail;
use App\Mail\NotifyForgot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ForgotPassController extends Controller
{
    public function index(){
        $title = "Password Recovery Form";
        return view ('pages.app.forgot', compact('title'));
    }

    public function forgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string|email|max:255|exists:users',
        ]);
        
        if ($validator->fails()) 
        {
            return redirect()->back()->with('error', 'Your Email Does not Exist')->withInput();
        }
        $data = Users::where('email', $request->email)->first();
        $mail = Mail::to($request->email)->send(new NotifyForgot($data));
        return redirect()->route('login')->with('success', 'Your Password Recovery Has been sent to Mail')
                                         ->withInput($request->input());
    }


    public function renewPassword($code)
    {
        $data = Users::where('password_reset_token', $code)->firstOrFail();
        return view('pages.app.new_password')->with('code', $code);
    }


    public function newPass(Request $request)
    {
        $get = Users::where('password_reset_token',$request->code)->first();

        $get->password = Hash::make($request->password);
        $get->save();

        return redirect()->route('login')->with('success', 'Your Password Updated, Please Login With New Password:');

    }
    
}
