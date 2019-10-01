<?php

namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Service\EvaluationService;
use DB;
class EvaluationController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @param  EvaluationService
     * @return void
     */
    public function __construct(EvaluationService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //

         $data = $this->service->triesome();
         foreach($data as $val){
            $val->note;
            $val->matiere;
            $val->classe;
         }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function create ()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $data = $request->all();

      $data = $this->service->create($data);
      return response()->json($data, '201');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
     $data=  $this->service->find($id);
        return response()->json($data, '200');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy ($id)
    {
        //Etablissement::destroy($id);
        //return response()->json("delete avec succes",'204');
        try{
           // $user= request()->user();
            $res = $this->service->delete($id);
            return response()->json("Suppression effectue avec succes",'204');
        } catch (\Exception $e) {
             Log::error($e->getMessage());
             return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
        }

    }

    function update (Request $request,$id)
    {

        try
            {
               // $user= request()->user();
                $data = $request->all();
                $res = $this->service->update($data, $id);
                if ($res) {
                    return response()->json($res, '201');
                }
            } catch (\Exception $e) {
                 Log::error($e->getMessage());
                        return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
            }

    }

    public function GetEMatiereByClasse($idclasse) {
        $qry = 'SELECT m.libelle
        FROM classes_matieres cm,matieres m
        WHERE cm.classe_id =  "'.$idclasse.'" AND cm.matiere_id = m.id  ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function GetEvaluation($idsemestre,$idtype,$idclasse,$idmat) {
        $qry = 'SELECT libelle
        FROM evaluations
        WHERE semestre_id =  "'.$idsemestre.'" AND typeevaluarions_id =  "'.$idtype.'"
        AND classe_id =  "'.$idclasse.'" AND matiere_id =  "'.$idmat.'"  ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

    public function GetNote($ideval,$ideleve) {
        $qry = 'SELECT m.libelle,n.value
        FROM evaluations e, notes n,matieres m
        WHERE e.id = "'.$ideval.'" AND m.id = e.matiere_id AND n.evaluation_id =  "'.$ideval.'" AND n.eleve_id =  "'.$ideleve.'" ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
}
