<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Departement;
use App\Models\Niveau;
use App\Service\ClasseService;

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
      
        $tab = $this->service->all();   
        $role=Role::whereLibelle($request->post("libelle"))->firstOrFail();  
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
        $data['libelleClasse']=$request->post("email");
        $data['effectif']=$request->post("civilite");
        $result=$this->service->create($data);
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
