<?php

namespace App\Repositories;

use App\Models\Adresse;

class AdresseRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Adresse();
	}
}