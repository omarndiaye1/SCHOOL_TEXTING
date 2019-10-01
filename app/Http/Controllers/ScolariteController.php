<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Mois;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Paiement_Scolarite;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\Paiement_Scolarite_Mois;
use App\Service\ScolariteService;
use Illuminate\Support\Str;
use DB;

class ScolariteController  extends BaseControllers
{


    /**
     * Create a new controller instance.
     *
     * @param  ScolariteRepository
     * @return void
     */
    public function __construct(ScolariteService $service)
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
        $data = $this->service->all();
       
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

        //Add Eleve
        $p= new Paiement_Scolarite();
        foreach($request->post("mois") as &$value){
            $p->nombremois = $p->nombremois +1;
        }
        $qry = 'SELECT   * FROM aneescholaires a WHERE a.etat =1 ' ;
        $data = DB::select($qry);
        $p->montant = $request->post("montant")* $p->nombremois ;
        $p->eleve_id = $request->post("eleve_id");
        $p->typepaiement_id = $request->post("typepaiement");
        $p->aneescholaires_id = 1;
        $p->save();
        foreach($request->post("mois") as &$value){
            $mois=new Mois();
            $pm=new Paiement_Scolarite_Mois();
            $mois=Mois::whereLibelle("$value")->firstOrFail();
            $pm->mois_id=$mois->id;
            $pm->paiementscolarite_id=$p->id;
            $pm->save();
        }
     
    

        return response()->json('Added succesfully');


    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
     $data= $this->service->find($id);
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

        //$user=User::findorfail($id);
        User::destroy($id);
        return response()->json("delete avec succes",'204');
        try{
           // $user= request()->user();
            $res = $this->service->delete($id);
            //$user->delete();
            return response()->json("Suppression effectue avec succes",'204');
        } catch (\Exception $e) {
             Log::error($e->getMessage());
             return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
        }

    }
    /*public function destroy(User $user)
    {
        $user->delete();

        return response()->json("Suppression effectue avec succes",'204');
    }*/

    function update (Request $request,$id)
    {

        try
            {
               // $user= request()->user();
                //$data = $request->all();
               
                if ($res) {
                    return response()->json($res, '201');
                }
            } catch (\Exception $e) {
                 Log::error($e->getMessage());
                        return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
            }

    }
    
    public function MonthsBypaiement($idEleve) {
        $qry = 'SELECT  DISTINCT m.libelle FROM mois m,paiement__scolarites p,paiement__scolarite__mois pm  WHERE p.eleve_id LIKE "'.$idEleve.'" AND pm.paiementscolarite_id=p.id  AND  m.id not in (select mois_id from paiement__scolarite__mois)  ' ;
       
        
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

    public function paiementScolariteByMonths($idEleve) {
        $qry = 'SELECT   m.libelle FROM mois m,paiement__scolarites p,paiement__scolarite__mois pm  WHERE p.eleve_id LIKE "'.$idEleve.'" AND pm.paiementscolarite_id = p.id  AND pm.mois_id = m.id  ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

}
