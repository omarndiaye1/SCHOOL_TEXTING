<?php

namespace App\Repositories;

use App\Models\Classes_matiere;

class Classes_matiereRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Classes_matiere();
	}
}
