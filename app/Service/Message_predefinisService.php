<?php

namespace App\Service;
use App\Repositories\Message_predefinisRepository;

class Message_predefinisService extends BaseService
{
    function __construct(Message_predefinisRepository $repository){
		$this->repository=new $repository;

	}
}
