<?php

namespace App\Service;
use App\Repositories\SemestreRepository;

class SemestreService extends BaseService
{
    function __construct(SemestreRepository $repository){
		$this->repository = new $repository;

	}
}
