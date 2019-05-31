<?php

namespace App\Repositories;

use App\Models\Salle;

class SalleRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Salle();
	}
}