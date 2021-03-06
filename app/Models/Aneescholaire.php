<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aneescholaire extends Model
{
    //
    protected $guarded=[];
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function semestre()
    {
        return $this->hasMany(Semestre::class);
    }

}
