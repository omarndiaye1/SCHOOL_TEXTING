<?php

namespace App\Repositories;

use App\Models\Jour;

class JourRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Jour();
	}
}
