<?php

namespace App\Service;
use App\Repositories\RoleRepository;

class RoleService extends BaseService
{
    function __construct(RoleRepository $repository){
		$this->repository=new $repository;
		
	}
}