<?php

namespace App\Service;
use App\Repositories\UtilisateurRepository;

class UtilisateurService extends BaseService
{
    function __construct(UtilisateurRepository $repository){
		$this->repository=new $repository;
		
	}
}