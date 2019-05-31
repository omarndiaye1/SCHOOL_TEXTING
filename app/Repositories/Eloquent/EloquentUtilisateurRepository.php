<?php

namespace App\Repositories\Eloquent;

use App\Models\Utilisateur;
use App\Repositories\Contracts\UtilisateurRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentUtilisateurRepository extends AbstractRepository implements UtilisateurRepository
{
    public function entity()
    {
        return Utilisateur::class;
    }
}
