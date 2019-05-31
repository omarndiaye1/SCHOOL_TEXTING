<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){
			
		$this->model=new Role();
	}
}