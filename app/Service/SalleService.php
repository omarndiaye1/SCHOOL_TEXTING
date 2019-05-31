<?php

namespace App\Service;
use App\Repositories\SalleRepository;

class SalleService extends BaseService
{
    function __construct(SalleRepository $repository){
		$this->repository=new $repository;
		
	}
}