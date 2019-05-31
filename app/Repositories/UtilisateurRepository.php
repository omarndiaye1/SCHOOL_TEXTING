<?php

namespace App\Repositories;

use App\Models\Utilisateur;

class UtilisateurRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Utilisateur();
	}
}