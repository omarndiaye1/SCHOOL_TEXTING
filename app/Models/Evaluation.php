<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guarded=[];
    public function note(){
        return $this->hasMany(Note::class);
    }
    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }
}
