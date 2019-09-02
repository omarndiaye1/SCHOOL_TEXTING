<?php

namespace App\Repositories;

use App\Models\Etablissement_adresses;

class Etablissement_adressesRepositry extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Etablissement_adresses();
	}
}
