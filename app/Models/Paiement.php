<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //
    protected $guarded=[];
    public function mois()
    {
        return $this->hasOne(Mois::class,'id','mois_id');
    }
    public function typepaiement()
    {
        return $this->hasOne(Typepaiement::class,'id','typepaiement_id');
    }
    public function eleves()
    {
        return $this->hasOne(Eleve::class,'id','eleve_id');
    }
}
