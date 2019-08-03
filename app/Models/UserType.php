<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';

    public function users(){
        return $this->hasMany('App\Users');
    }
    
    
    /*
    public function userID(){
        return $this->id;
    }
    */
}
