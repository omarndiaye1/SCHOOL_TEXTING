<?php

namespace App\Repositories;

use App\Models\Message_predefinis;

class Message_predefinisRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Message_predefinis();
	}
}
