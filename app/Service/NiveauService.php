<?php

namespace App\Service;
use App\Repositories\NiveauRepository;

class NiveauService extends BaseService
{
    function __construct(NiveauRepository $repository){
		$this->repository=new $repository;
		
	}
}