<?php

namespace App\Service;
use App\Repositories\TypeevaluationRepository;

class TypeevaluationService extends BaseService
{
    function __construct(TypeevaluationRepository $repository){
		$this->repository=new $repository;

	}
}
