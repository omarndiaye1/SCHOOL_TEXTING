<?php

namespace App\Repositories;

use App\Models\Historique_profs;

class Historique_profsRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Historique_profs();
	}
}
