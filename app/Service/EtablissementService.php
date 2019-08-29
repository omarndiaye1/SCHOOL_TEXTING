<?php

namespace App\Service;
use App\Repositories\EtablissementRepository;

class EtablissementService extends BaseService
{
    function __construct(EtablissementRepository $repository){
		$this->repository=new $repository;

	}
}
