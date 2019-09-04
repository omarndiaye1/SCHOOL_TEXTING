<?php

namespace App\Repositories;

use App\Models\Enseignant;

class EnseignantRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Enseignant();
	}
	
 
}