<?php

namespace App\Service;
use App\Repositories\ClasseRepository;

class ClasseService extends BaseService
{
    function __construct(ClasseRepository $repository){
		$this->repository=new $repository;
		
	}
}