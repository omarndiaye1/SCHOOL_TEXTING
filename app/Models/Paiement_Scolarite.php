<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement_Scolarite extends Model
{
    //
    protected $guarded=[];
   
    public function typepaiement()
    {
        return $this->hasOne(Typepaiement::class,'id','typepaiement_id');
    }
    public function eleves()
    {
        return $this->hasOne(Eleve::class,'id','eleve_id');
    }
    public function mois()
    {
        return $this->belongsToMany(Mois::class, 'paiement_scolarite_mois');
    }
}
