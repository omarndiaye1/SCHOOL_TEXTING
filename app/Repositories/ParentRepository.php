<?php

namespace App\Repositories;

use App\Models\Parente;

class ParentRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Parente();
	}
}
