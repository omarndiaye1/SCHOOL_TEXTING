<?php

namespace App\Service;
use App\Repositories\ParentRepository;

class ParentService extends BaseService
{
    function __construct(ParentRepository $repository){
		$this->repository=new $repository;

	}
}
