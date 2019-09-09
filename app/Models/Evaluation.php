<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guarded=[];
    public function note(){
        return $this->hasMany(Note::class);
    }
}
