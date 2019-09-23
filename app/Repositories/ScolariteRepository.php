<?php

namespace App\Repositories;

use App\Models\Paiement_Scolarite;

class ScolariteRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Paiement_Scolarite();
	}
	
 
}