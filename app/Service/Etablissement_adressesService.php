<?php

namespace App\Service;
use App\Repositories\Etablissement_adressesRepositry;

class Etablissement_adressesService extends BaseService
{
    function __construct(Etablissement_adressesRepositry $repository){
		$this->repository=new $repository;

	}
}
