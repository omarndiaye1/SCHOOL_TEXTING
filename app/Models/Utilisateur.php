<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    //
    protected $guarded=[];
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_user', 'user_id', 'role_id');
    }
    public function usertable(){
        return $this->morphTo();
    }
}
