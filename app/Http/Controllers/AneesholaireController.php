<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aneescholaire;
use App\Models\Semestre;
use App\Service\AneescholaireService;

class AneesholaireController  extends BaseControllers
{
    	/**
     * Create a new controller instance.
     *
     * @param  DepartementRepository
     * @return void
     */
    public function __construct(AneescholaireService $service)
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
        foreach($data as $val){
            $val->semestre;
            $val->classes;
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
      //$data = $request->all();
      $an = new Aneescholaire();
      $an->libelle =$request->post("libelle");
      $an->datedep =$request->post("datedep");
      $an->datefin =$request->post("datefin");
      $an->etat =$request->post("etat");
      $an->save();
    //   $data['libelle']=$request->post("libelle");
    //   $data['datedep']=$request->post("datedep");
    //   $data['datefin']=$request->post("datefin");
    //   $data['etat']=$request->post("etat");
    //   $tuchi = $this->service->create($data);

      $semenstre1 = new Semestre();
      $semenstre1->libelle = 'Premier';
      $semenstre1->etat = true;
      $semenstre1->aneescholaire_id = $an->id;
      $semenstre1->save();

      $semenstre2 = new Semestre();
      $semenstre2->libelle = 'Second';
      $semenstre2->etat = false;
      $semenstre2->aneescholaire_id = $an->id;
      $semenstre2->save();

      return response()->json($an, '201');
    }

    /**
     * Display the specified aresource.
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
}
