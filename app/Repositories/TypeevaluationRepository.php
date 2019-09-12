<?php

namespace App\Repositories;

use App\Models\Typeevaluation;

class TypeevaluationRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Typeevaluation();
	}
}
