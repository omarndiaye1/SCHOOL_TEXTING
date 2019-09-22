<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Message();
	}
}
