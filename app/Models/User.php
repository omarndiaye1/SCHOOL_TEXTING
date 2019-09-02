<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $guarded=[];

    /*public function roles()
    {
        //return $this->belongsToMany('App\Models\Role','role_user', 'user_id', 'role_id');
        return $this->belongsTo('App\Models\Role','user_id');
    }*/
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role__users');
    }

    /*public function usertable(){
        return $this->morphTo();
    }*/
}
