<?php

namespace App\Repositories;

use App\Models\Etablissement;

class EtablissementRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Etablissement();
	}
}
