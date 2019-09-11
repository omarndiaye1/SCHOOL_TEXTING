<?php

namespace App\Repositories;

use App\Models\Evaluation;
use Illuminate\Support\Facades\DB;
class EvaluationRepository extends BaseRepository implements BaseRepositoryInterface
{
    function __construct(){

		$this->model=new Evaluation();
    }
    function getsome(){

		return $this->model->skip(0)->take(1)->get();
    }
    // function triesome(){

    //     return $this->model
    //                 ->leftJoin('semestres','semestres.id','=','evaluations.semestre_id')
    //                 ->where('semestres.etat','=','1')
    //                 ->orderBy('evaluations.id','DESC')
    //                 ->take(5)
    //                 ->get();
    // }
    function triesome(){

        return $this->model
                    ->whereExists(function ($query){
                        $query->select(DB::raw(1))
                        ->from('semestres')
                        ->whereRaw('semestres.id = semestre_id')
                        ->whereRaw('semestres.etat = 1');
                    })
                    ->orderBy('evaluations.id','DESC')
                    ->get();
    }
}
