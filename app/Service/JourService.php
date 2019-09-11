<?php

namespace App\Service;
use App\Repositories\JourRepository;

class JourService extends BaseService
{
    function __construct(JourRepository $repository){
		$this->repository=new $repository;

	}
}
