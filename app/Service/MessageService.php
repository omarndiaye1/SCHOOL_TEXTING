<?php

namespace App\Service;
use App\Repositories\MessageRepository;

class MessageService extends BaseService
{
    function __construct(MessageRepository $repository){
		$this->repository=new $repository;

	}
}
