<?php

namespace App\Http\Controllers\Web\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\Users;
use App\Models\Todo_list;

use Mail;
use App\Mail\NotifyTask;
use App\Helpers\Crud;

class BaseUserController extends Controller
{

    public function __construct()
    {
        //
    }

    public function dashboard()
    {
        return view ('pages.app.master');
    }

    public function manageTask()
    {
        $user = Auth::user()->id;
        $data = new Todo_list;
        $data = Todo_list::where('users_id',$user)->get();

        foreach($data as $item){

            $now = Carbon::now(); //Get Now datetime
            $scheduled = Carbon::parse($item->scheduled); //parse database datetime to carbon type datetime
        
            if($scheduled->isPast()){
                if ($item->is_complete == 1 or $item->is_complete == 5)
                {
                    return view('pages.app.user_manage_task')->with('data',$data);  
                }
                else
                {
                    $item->is_complete = 3 ;
                    $item->save();
                }
            }
            else
            {
                if ($item->is_complete == 1 or $item->is_complete == 5)
                {
                    return view('pages.app.user_manage_task')->with('data',$data);  
                }
                else
                {
                    if( $scheduled < $now->addMinutes(30) )
                    {
                        $item->is_complete = 2 ;
                        $item->save();

                        $where= Users::where('id', $item->users_id)->first();
                        $desc = $item->description;

                        if ($item->notified == 0){
                            $mail = Mail::to($where->email)->send(new NotifyTask($desc));
                            $item->notified = 1;
                            $item->save();
                        }
                    }
                    else{        
                        $item->is_complete = 0;                    
                        $item->save();  
                    }
                }
            } 
        }
        return view('pages.app.user_manage_task')->with('data',$data);
    }

    public function addTask(Request $request)
    {
        $input= new Todo_list();
        $input->description=$request->desc;
        $input->scheduled=$request->scheduled;
        $input->created_at = Carbon::now();
        $input->is_complete=0;
        $input->users_id=Auth::user()->id;
        $input->notified = 0;
        $input->save();
        
        return redirect()->route('user.task')->with('success','Your New Task Has been Created');
    }

    public function editTask($id)
    {
        // task status reminder 
        // 0. task on progress
        // 1. completed normally by user check
        // 2. notified to user email
        // 3. the task already expired because due time is passed without any user check
        // 5. delayed status if user insist to click on the task to complete.
        // dd('aksdlasnda', $id);
        $data= Todo_list::findOrFail($id);

        if($data->is_complete == 0) // if task is accidentally completed on click, this one for redo
        {
            $data->update(['is_complete' => 1]);
        }
        else if ($data->is_complete == 1) // task has been notified and can be completed normally
        {
            $data->update(['is_complete' => 0]);
        }
        else if ($data->is_complete == 2) // task is still on progress state, can be completed normally
        {
            $data->update(['is_complete' => 1]);
        }
        else if ($data->is_complete == 3)       // task is expired because it has passed the due time
        {                                       // can be completed with added messages "delayed"
            $data->update(['is_complete' => 5]);
        }
        
        return $data    ? redirect()->back()->with('success','Your Task Has Been Updated')
                        : back()->with('error','Invalid Action');
    }

    public function deleteTask(Request $request)
    {        
        $data= Todo_list::findOrFail($request->id);

        if($data->is_complete != 3){
            return response()->json(['error'=>'Cannot Remove Incomplete Task']);
        }
        else{
            $data->delete();
            return $data    ? redirect()->route('user.task')->with('success','Your Task Has Been Removed')
                        : route('user.task')->with('error','Invalid Action');
        }
    }

    public function viewEditTask($id)
    {
        $id = Todo_list::findOrFail($id);
        if($id->is_complete == 1){
            return redirect()->route('user.task')->with('warning', 'Cannot Edit the task that has been completed');
        }
        else{
            return view ('pages.app.user_edit_task', compact('id'));
        }
    }

    public function updateUserTasks(Request $request)
    {

        $data = Todo_list::findOrFail($request->id);
        $data->description=$request->desc;
        $data->scheduled=$request->scheduled;
        $data->save();

        return redirect()->route('user.task')->with('success','Your Task Has Been Updated');
    }
}
