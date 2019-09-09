<?php

namespace App\Repositories;

use App\Models\Inscription;

class InscriptionRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Inscription();
	}
}
