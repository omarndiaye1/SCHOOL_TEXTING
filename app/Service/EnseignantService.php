<?php

namespace App\Service;
use App\Repositories\EnseignantRepository;

class EnseignantService extends BaseService
{
    function __construct(EnseignantRepository $repository){
		$this->repository=new $repository;

	}
}
