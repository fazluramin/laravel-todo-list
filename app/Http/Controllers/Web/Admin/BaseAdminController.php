<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Todo_list;
use App\Helpers\Crud;
use Illuminate\Support\Facades\Validator;

use App\Mail\InvitationUser;
use App\Mail\InvitationAdmin;
use App\Mail\ResetPasswordAccount;
use Mail;


class BaseAdminController extends Controller
{
    public function __construct()
    {
        //
    }

    public function dashboard()
    {
        return view ('pages.admin.master');
    }

//--------------------------------------------------------------------------------
//                      Controller for Admin management Page 
//-------------------------------------------------------------------------------- 
    public function manageAdmins()
    {
        $data = Crud::getWhere(new Users, 'user_type_id', 1)->get();
        return view ('pages.admin.admin_manage', compact('data'));
    }

    public function addAdmins(Request $request)
    {
        // $rules=['email' => 'required|string|email|max:255|unique:users,email'];
        // Crud::validator($request, $rules);

        $validator = Validator::make($request->all(), 
        [
            'email' => 'required|string|email|max:255|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.man.admins')->with('error','Email Has been registered')
                        // ->withErrors($validator)
                        ->withInput();
        }

        $input = new Users;
        $input->full_name = 'admin'.str_random(4);
        $input->password = str_random(6);
        $input->email = $request->email;
        $input->password_reset_token = str_random(60);
        $input->is_active=0;
        $input->user_type_id=1;
        $input->save();

        $mail = Mail::to($request->email)->send(new InvitationAdmin($input));
        
        return redirect()->route('admin.man.admins')->with('success','Admin Invitation Sent');
    }

    public function newAdminInvite($code)
    {
        $code = $code;
        return view('pages.admin.new_admin_invite', compact('code'));
    }

    public function postNewAdmin(Request $request)
    {
        $data = Crud::getWhere(new Users, 'password_reset_token', $request->code)->first();

        $rules=['password' => 'required|min:4'];
        Crud::validator($request, $rules);

        $data->full_name = $request->fullname;
        $data->password = Hash::make($request->password);
        $data->is_active = 1;
        $data->save();

        return redirect()->route('login')->with('success','account created, please login');
    }

    public function editAdmins($id)
    {
        $id = Users::findOrFail($id);
        return view('pages.admin.admin_edit_admin', compact('id'));
    }

    public function updateAdmins(Request $request)
    {
        $rules=['email' => 'required|string|email|max:255|unique:users'];
        Crud::validator($request, $rules);

        $data = Users::findOrFail($request->id);
        $data->full_name=$request->fullname;
        $data->email=$request->email;
        $data->save();

        return redirect()->route('admin.man.admins')->with('success','Data Updated');
    }

    public function deleteAdmins(Request $request)
    {
        $data= Users::findOrFail($request->id);
        $data->delete();

        return $data ? redirect()->route('admin.man.admins')->with('success','Data Removed From Database')
                     : route('admin.man.admins')->with('danger','Invalid Action');
    }
    
    public function profileAdmins(){
        return view ('pages.admin.admin_profile_admin');
    }

    public function postProfileAdmins(Request $request){

        $data = Users::findOrFail($request->id);

        $validator = Validator::make($request->all(), 
        [
            'fullname' => 'required|string|max:255',
            'password' => 'required|string|min:5|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile.admins')->with('error','Please Check Your Input Again')
                        // ->withErrors($validator)
                        ->withInput();
        }

        $data->full_name=$request->fullname;
        $data->password=Hash::make($request->password);
        $data->save();

        return redirect()->route('admin.man.admins')->with('success','Data Updated');
    }


//--------------------------------------------------------------------------------
//                      Controller for User management Page 
//--------------------------------------------------------------------------------

    public function manageUsers()
    {
        $data = new Users;
        $data = Users::where('user_type_id', '2')->get();
        return view ('pages.admin.admin_manage_user', compact('data'));
    }

    public function addUsers(Request $request)
    {
        // $rules=[];
        // Crud::validator($request, $rules);
        $validator = Validator::make($request->all(), 
        [
            'email' => 'required|string|email|max:255|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.man.users')->with('error','Email Has been registered')
                        // ->withErrors($validator)
                        ->withInput();
        }

        $input = new Users;
        $input->full_name = 'user'.str_random(4);
        $input->password = str_random(6);
        $input->email = $request->email;
        $input->password_reset_token = str_random(60);
        $input->is_active=0;
        $input->user_type_id=2;
        $input->save();

        $mail = Mail::to($request->email)->send(new InvitationUser($input));
        
        return redirect()->route('admin.man.users')->with('success','User Invitation Sent to '.$request->email.'');
    }

    public function editUsers($id)
    {
        $id = Users::findOrFail($id);
        return view('pages.admin.admin_edit_user', compact('id'));
    }

    public function updateUsers(Request $request)
    {   
        $data = Users::findOrFail($request->id);
            $data->full_name=$request->fullname;
            $data->email=$request->email;
        $data->save();

        return redirect()->route('admin.man.users')->with('success','Success! Data Updated');
    }

    public function deleteUsers(Request $request)
    {
        $task= Todo_list::where('users_id', $request->id)->delete();

        $data= Users::findOrFail($request->id);
        $data->delete();

        return $data ? redirect()->route('admin.man.users')->with('success','Data Removed From Database')
                     : route('admin.man.users')->with('danger','Invalid Action');;
    }
    
    public function newUserInvite($code)
    {
        return view('pages.admin.new_user_invite')->with($code);
    }

    public function postNewUser(Request $request)
    {
        $data = Users::where('password_reset_token', $request->code)->first();
        $data->full_name = $request->fullname;
        $data->password = Hash::make($request->password);
        $data->is_active = 1 ;
        $data->save();

        return redirect()->route('login')->with('success','account created, please login');
    }

    public function resetUserPassword($id)
    {
        $data = Users::findOrFail($id);
        $data->password_reset_token=str_random(60);
        $data->update(); 
        
        $mail = Mail::to($data->email)->send(new ResetPasswordAccount($data));

        return redirect()->route('admin.man.users')->with('success','Reset Pasword Account Has been sent to '.$data->email.'');
    }

    public function activateDeactivate($id)
    {
        $data = Users::findOrFail($id);

        //Comparing the data fetched from DB and compare to 1 as active | or 0 as inactive 
        if($data->is_active == 1) 
        {
            $data->is_active = 0;
            $data->update();
            return redirect()->route('admin.man.users');
        }
        else
        {
            $data-> is_active = 1;
            $data->update();
            return redirect()->route('admin.man.users');
        }
    }
    
}
