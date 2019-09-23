<?php

namespace App\Service;
use App\Repositories\ScolariteRepository;

class ScolariteService extends BaseService
{
    function __construct(ScolariteRepository $repository){
		$this->repository=new $repository;

	}
}
