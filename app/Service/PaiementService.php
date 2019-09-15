<?php

namespace App\Service;
use App\Repositories\PaiementRepository;

class PaiementService extends BaseService
{
    function __construct(PaiementRepository $repository){
		$this->repository=new $repository;

	}
}
