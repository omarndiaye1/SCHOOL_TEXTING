<?php

namespace App\Repositories;

use App\Models\Paiement;

class PaiementRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Paiement();
	}
	
 
}