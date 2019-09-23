<?php

namespace App\Repositories;

use App\Models\Bultin;

class BultinRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Bultin();
	}
}
