<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $guarded=[];

    /*public function utilisateurs()
    {
        //return $this->belongsToMany('App\Utilisateur','role_user', 'user_id', 'role_id');
        return $this->belongsTo('App\Models\Role','role_id');
    }*/

    public function users()
    {
        return $this->belongsToMany(User::class, 'role__users');
    }
}
