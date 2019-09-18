<?php

namespace App\Repositories;

use App\Models\Typeevaluarions;

class TypeevaluationRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Typeevaluarions();
	}
}
