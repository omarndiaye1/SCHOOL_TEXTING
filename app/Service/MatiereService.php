<?php

namespace App\Service;
use App\Repositories\MatiereRepository;

class MatiereService extends BaseService
{
    function __construct(MatiereRepository $repository){
		$this->repository=new $repository;
		
	}
}