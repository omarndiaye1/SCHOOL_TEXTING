<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Service\EtablissementService;
use DB;
class EtablissementController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @param  EtablissementRepository
     * @return void
     */
    public function __construct(EtablissementService $service)
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
            $val->adresses;
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
        Etablissement::destroy($id);
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

    public function NbreEleve() {
        $qry = 'SELECT COUNT(DISTINCT e.id) AS nbreEleve
        FROM eleves e,inscriptions i,aneescholaires an
        WHERE e.id = i.eleve_id AND an.id = i.anneescolaire_id AND an.etat = 1 ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function NbreGarcon() {
        $qry = 'SELECT COUNT(DISTINCT e.id) AS NbreGarcon
        FROM eleves e,inscriptions i,aneescholaires an
        WHERE e.id = i.eleve_id AND an.id = i.anneescolaire_id AND an.etat = 1 AND e.sexe = "Masculin" ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function NbreFille() {
        $qry = 'SELECT COUNT(DISTINCT e.id) AS NbreFille
        FROM eleves e,inscriptions i,aneescholaires an
        WHERE e.id = i.eleve_id AND an.id = i.anneescolaire_id AND an.etat = 1 AND e.sexe = "Feminin" ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function NbreClasse() {
        $qry = 'SELECT COUNT(DISTINCT cl.id) AS NbreClasse
        FROM classes cl,aneescholaires an
        WHERE an.id = cl.aneescholaire_id AND an.etat = 1' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
    public function NbreProf() {
        $qry = 'SELECT COUNT(*) AS NbreProf
        FROM enseignants';
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

    public function NbreMessageSend() {
        $qry = 'SELECT COUNT(*) AS NbreMessageSend
        FROM messages';
        $data = DB::select($qry);
        return response()->json($data, '200');
    }
}
