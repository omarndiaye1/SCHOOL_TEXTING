<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    //
    protected $guarded=[];
    
    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }
}
