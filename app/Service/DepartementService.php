<?php

namespace App\Service;
use App\Repositories\DepartementRepository;

class DepartementService extends BaseService
{
    function __construct(DepartementRepository $repository){
		$this->repository=new $repository;
		
	}
}