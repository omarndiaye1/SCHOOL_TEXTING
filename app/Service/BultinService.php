<?php

namespace App\Service;
use App\Repositories\BultinRepository;

class BultinService extends BaseService
{
    function __construct(BultinRepository $repository){
		$this->repository=new $repository;

	}
}
