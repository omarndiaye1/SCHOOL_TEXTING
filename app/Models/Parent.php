<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parente extends Model
{
    protected $guarded=[];
    public function utilisateurs()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function enfants()
    {
        return $this->hasMany(Eleve::class);
    }

    public function adresses()
    {
        return $this->hasMany(Adresse::class,'id', 'user_id');
    }
}
