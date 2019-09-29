<?php

namespace App\Service;
use App\Repositories\Historique_parentsRepository;

class Historique_parentsService extends BaseService
{
    function __construct(Historique_parentsRepository $repository){
		$this->repository=new $repository;

	}
}
