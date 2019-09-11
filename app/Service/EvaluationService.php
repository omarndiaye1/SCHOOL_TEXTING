<?php

namespace App\Service;
use App\Repositories\EvaluationRepository;

class EvaluationService extends BaseService
{
    function __construct(EvaluationRepository $repository){
		$this->repository=new $repository;

    }
    function triesome(){

        return $this->repository->triesome();
    }
}
