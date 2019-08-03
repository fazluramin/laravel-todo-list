<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo_list extends Model
{
    protected $table='todo_list';

    public $timestamps = false;

    protected $fillable = [
        'description', 'scheduled', 'created_at', 'is_complete', 'users_id', 'notified'
    ];

    public function users()
    {
        return $this->belongsTo('App\Users');
    }

    public static function getTime()
    {
        
    }
}
