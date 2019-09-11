<?php

namespace App\Service;
use App\Repositories\HoraireRepository;

class HoraireService extends BaseService
{
    function __construct(HoraireRepository $repository){
		$this->repository=new $repository;

	}
}
