<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes_matiere extends Model
{
    //
    protected $guarded=[];
     public function matiere()
     {
         return $this->belongsTo('App\Models\Matiere');
     }

    // public function departement()
    // {
    //     return $this->belongsTo('App\Models\Departement');
    // }

    // public function evaluation(){
    //     return $this->hasMany(Evaluation::class);

    // }
    // //return $this->hasOne(Eleve::class,'id','eleve_id');

    // public function inscription(){
    //     $data =  $this->hasMany(Inscription::class);

    //     return $data;
    // }
    // public function cour(){
    //     $data =  $this->hasMany(Cour::class);

    //     return $data;
    // }

}
