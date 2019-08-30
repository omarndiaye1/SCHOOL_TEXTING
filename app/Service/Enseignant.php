<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    //
    protected $guarded=[];
    public function utilisateur()
    {
        return $this->belongsTo('App\Models\Utilisateur');
    }
    
}
