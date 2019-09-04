<?php

namespace App\Repositories;

use App\Models\Aneescholaire;

class AneescholaireRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Aneescholaire();
	}
}
