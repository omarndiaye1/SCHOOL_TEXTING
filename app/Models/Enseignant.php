<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    //
    protected $guarded=[];
    public function utilisateurs()
    {
        return $this->hasOne(User::class,'id','user_id');
    }


}
