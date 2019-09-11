<?php

namespace App\Service;
use App\Repositories\NoteRepository;

class NoteService extends BaseService
{
    function __construct(NoteRepository $repository){
		$this->repository=new $repository;

	}
}
