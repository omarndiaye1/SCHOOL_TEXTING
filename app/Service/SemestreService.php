<?php

namespace App\Service;
use App\Repositories\SemestreRepository;

class SemestreService extends BaseService
{
    function __construct(SemestreRepository $repository){
		$this->repository = new $repository;

    }
    function getsome(){

		return $this->repository->getsome();
    }
    function triesome(){

		return $this->repository->triesome();
    }
}
