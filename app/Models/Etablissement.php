<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $guarded=[];
    public function adresses(){
        return $this->hasMany(Etablissement_adresses::class);
    }
}
