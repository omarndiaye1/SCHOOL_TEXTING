<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
    protected $guarded=[];
    
    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }
}
