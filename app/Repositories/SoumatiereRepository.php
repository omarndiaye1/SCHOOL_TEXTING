<?php

namespace App\Repositories;

use App\Models\Soumatiere;

class SoumatiereRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Soumatiere();
	}
}
