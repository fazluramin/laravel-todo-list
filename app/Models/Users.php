<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Users extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'full_name', 'email', 'is_active', 'user_type_id', 'password'
    ];

    protected $hidden = ['password'];
    
    public function userType(){
        return $this->belongsTo('App\UserType');
    }

    public function todoList(){
        return $this->hasMany('App\Todo_list');
    }

    public function activateAccount($code)
    {
        $user = Users::where('password_reset_token', $code)->first();
        
        if($user){
            $user->update(['is_active' => 1, 'password_reset_token' => str_random(60)]);
            Auth::login($user);
            return true;
        }
    }

    
}
