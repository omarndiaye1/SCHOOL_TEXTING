<?php

namespace App\Service;
use App\Repositories\AdresseRepository;

class AdresseService extends BaseService
{
    function __construct(AdresseRepository $repository){
		$this->repository=new $repository;
		
	}
}