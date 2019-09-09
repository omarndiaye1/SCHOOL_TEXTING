<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Note();
	}
}
