<?php

namespace App\Repositories;

use App\Models\Semestre;

class SemestreRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Semestre();
	}
}
