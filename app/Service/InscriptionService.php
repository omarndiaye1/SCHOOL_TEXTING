<?php

namespace App\Service;
use App\Repositories\InscriptionRepository;

class InscriptionService extends BaseService
{
    function __construct(InscriptionRepository $repository){
		$this->repository=new $repository;

	}
}
