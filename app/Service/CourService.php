<?php

namespace App\Service;
use App\Repositories\CourRepository;

class CourService extends BaseService
{
    function __construct(CourRepository $repository){
		$this->repository=new $repository;

	}
}
