<?php

namespace App\Repositories;

use App\Models\Eleve;

class EleveRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Eleve();
	}
}
