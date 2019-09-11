<?php

namespace App\Repositories;

use App\Models\Semestre;

class SemestreRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Semestre();
    }

    function getsome(){

		return $this->model->skip(0)->take(1)->get();
    }
    function triesome(){

		return $this->model->orderBy('id','DESC')->take(5)->get();
    }
}
