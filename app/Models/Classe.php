<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //
    protected $guarded=[];
    public function niveau()
    {
        return $this->belongsTo('App\Models\Niveau');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function evaluation(){
        return $this->hasMany(Evaluation::class);

    }
    //return $this->hasOne(Eleve::class,'id','eleve_id');

    public function inscription(){
        $data =  $this->hasMany(Inscription::class);

        return $data;
    }

}
