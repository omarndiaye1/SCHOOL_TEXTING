<?php

namespace App\Repositories;

use App\Models\Classe;

class ClasseRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Classe();
	}
}