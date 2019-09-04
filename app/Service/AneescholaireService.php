<?php

namespace App\Service;
use App\Repositories\AneescholaireRepository;

class AneescholaireService extends BaseService
{
    function __construct(AneescholaireRepository $repository){
		$this->repository=new $repository;
	}
}
