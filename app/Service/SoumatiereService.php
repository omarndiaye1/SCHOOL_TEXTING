<?php

namespace App\Service;
use App\Repositories\SoumatiereRepository;

class SoumatiereService extends BaseService
{
    function __construct(SoumatiereRepository $repository){
		$this->repository=new $repository;

	}
}
