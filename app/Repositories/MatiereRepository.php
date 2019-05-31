<?php

namespace App\Repositories;

use App\Models\Matiere;

class MatiereRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Matiere();
	}
}