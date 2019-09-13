<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Departement;
use App\Models\Niveau;
use App\Service\ClasseService;
use App\Models\Cour;
use DB;

class ClasseController  extends BaseControllers
{
    	/**
     * Create a new controller instance.
     *
     * @param  ClasseRepository
     * @return void
     */

    public function __construct(ClasseService $service)
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

        $data = $this->service->all();

        return $data;
    }
    public function getCour($id)
    {


        $data = $this->service->find($id);
        $data->cour;
        foreach($data->cour as $val){
            $val->matiere;
            $val->prof;
            $val->prof->utilisateurs;
            $val->salle;
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
        $dep=new Departement();
        $niv=new Niveau();
        $departements= $dep->all();
        $niveaux= $niv->all();
        $data['niveaux']=$niveaux;
        $data['departements']=$departements;
         return response()->json($data);

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
      $this->service->create($data);
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

            // $qry = 'SELECT e.id,e.nom,e.prenom,e.sexe,e.email,e.datenaissance,e.lieu,e.adresse,e.ville,e.pays,e.photo,
            // cl.id as idClasse,cl.libelleClasse,cl.departement_id, cl.niveau_id,
            // p.profession,p.id as parent_id,u.nom as nomparent,u.prenom as prenomparent,u.email as parentemail,u.civilite,u.tel as parentTel,p.tel2,u.photo as parentphoto
            // FROM parentes p,eleves e,classes cl,users u WHERE e.parente_id =p.id AND e.classe_id = cl.id AND p.user_id = u.id' ;
            // //$qry = 'SELECT * FROM eleves e ' ;
            // $data = DB::select($qry);
            // return response()->json($data, '200');


     $data =  $this->service->find($id);
        //$data1 =
        // $data->evaluation;
        $data1['insc'] =  $data->inscription;
         foreach($data1['insc'] as &$value){
             $value->eleves;
             //$value->adresses;
         }
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
        Role::destroy($id);
        return response()->json("delete avec succes",'204');
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
    public function showClasse($departement_id,$niveau_id) {
        $qry = 'SELECT * FROM classes WHERE departement_id LIKE "'.$departement_id.'" AND niveau_id LIKE "'.$niveau_id.'%" ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function showClasseWithoutLevel($departement_id) {
        $qry = 'SELECT * FROM classes WHERE departement_id LIKE "'.$departement_id.'" AND niveau_id is NULL ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
}
