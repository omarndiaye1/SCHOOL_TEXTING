<?php

namespace App\Repositories;

use App\Models\Historique_parents;

class Historique_parentsRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Historique_parents();
	}
}
