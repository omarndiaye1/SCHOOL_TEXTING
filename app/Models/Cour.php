<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    //
    protected $guarded=[];
    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }
    public function prof()
    {
        return $this->belongsTo('App\Models\Enseignant');
    }
    public function salle()
    {
        return $this->belongsTo('App\Models\Salle');
    }

}
