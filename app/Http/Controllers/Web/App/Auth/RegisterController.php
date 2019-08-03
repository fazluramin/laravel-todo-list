<?php

namespace App\Http\Controllers\Web\App\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use \stdClass;
use App\Models\Users;

use Mail;
use App\Mail\NotifyRegister;

class RegisterController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getRegister(){
        return view('pages.app.register'); 
    }
    
    public function storeRegister(Request $request)
    {
        $request->flash();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //Saving Registered Data
        $data = new Users;
            $data->full_name=$request->name;
            $data->email=$request->email;
            $data->password=Hash::make($request->password);
            $data->password_reset_token=str_random(60);
            $data->is_active='0';
            $data->user_type_id='2';
        $data->save();

        $mail = Mail::to($request->email)->send(new NotifyRegister($data));

        return $data   ? redirect()->route('login')->with('success','account created, Check Email for Activation')
                                : redirect()->back()->with('error','your data is invalid!');
    }   

    public function activateUser($code, Users $user)
    {
        if ($user->activateAccount($code)) {
            return redirect()->route('login')->with('success','Account activated, Please Login');
        }
        return redirect()->back()->with('error','Activation Failed');
        
    }
}
