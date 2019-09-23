<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{
    //
    protected $guarded=[];
    public function paiements()
    {
        return $this->belongsToMany(Paiement::class,'paiement_mois');
    }
}
