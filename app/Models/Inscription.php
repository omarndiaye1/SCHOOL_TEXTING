<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    //
    protected $guarded=[];
    public function eleves()
    {
        return $this->hasOne(Eleve::class,'id','eleve_id');
    }
}
