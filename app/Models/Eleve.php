<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $guarded=[];
    public function parents()
    {
        return $this->hasOne(User::class,'id','parent_id');
    }
}
