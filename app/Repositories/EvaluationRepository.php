<?php

namespace App\Repositories;

use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Evaluation();
	}
}
