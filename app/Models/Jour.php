<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jour extends Model
{
    //
    protected $guarded=[];
    public function cour()
    {
        return $this->hasMany('App\Models\Cour');
    }
}
