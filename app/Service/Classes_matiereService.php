<?php

namespace App\Service;
use App\Repositories\Classes_matiereRepository;

class Classes_matiereService extends BaseService
{
    function __construct(Classes_matiereRepository $repository){
		$this->repository=new $repository;

	}
}
