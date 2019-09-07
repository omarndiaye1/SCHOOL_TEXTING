<?php

namespace App\Service;
use App\Repositories\EleveRepository;

class EleveService extends BaseService
{
    function __construct(EleveRepository $repository){
		$this->repository=new $repository;

	}
}
