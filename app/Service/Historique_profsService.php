<?php

namespace App\Service;
use App\Repositories\Historique_profsRepository;

class Historique_profsService extends BaseService
{
    function __construct(Historique_profsRepository $repository){
		$this->repository=new $repository;

	}
}
