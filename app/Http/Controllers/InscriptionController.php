<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Eleve;
use App\Models\Parente;
use App\Models\Role;
use App\Models\Role_User;
use App\Service\InscriptionService;
use Illuminate\Support\Str;
use DB;
class InscriptionController  extends BaseControllers
{
    	/**
     * Create a new controller instance.
     *
     * @param  SalleRepository
     * @return void
     */
    public function __construct(InscriptionService $service)
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
        //eleves

        $data = $this->service->all();
        foreach($data as &$value){
            $value->eleves;
            //$value->adresses;
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
        $us= new User();
        $us->login=$request->post("login");
        $us->password=$request->post("password");
        $us->nom=$request->post("nomP");
        $us->prenom=$request->post("prenomP");
        $us->sexe=$request->post("sexeP");
        $us->datenaissance=$request->post("datenaissanceP");
        $us->tel=$request->post("telP");
        $us->email=$request->post("emailP");
        $us->civilite=$request->post("civilite");
        $us->photo= $request->post("photoP");
        $us->email_verified_at= now();
        $us->remember_token= Str::random(10);
        $us->save();

        //Ajout Parent
        $par=new Parente();
        $par->profession = $request->post("profession");
        $par->tel2 = $request->post("tel2");
        $par->fixe = $request->post("fixe");
        $par->user_id = $us->id;
        $par->save();

        //Ajout adresse
        $adresse=new Adresse();
        $adresse->libelle=$request->post("adresseP");
        $adresse->ville=$request->post("villeP");
        $adresse->pays=$request->post("paysP");
        $adresse->user_id= $us->id;
        $adresse->save();

        //Ajout dans la table d'association
        $role_user=new Role_User();
        $role=new Role();
        $role=Role::whereLibelle($request->post("role"))->firstOrFail();
        $role_user->role_id=$role->id;
        $role_user->user_id= $us->id;
        $role_user->save();

        //Add Eleve
        $el= new Eleve();
        $el->nom = $request->post("nom");
        $el->prenom = $request->post("prenom");
        $el->sexe = $request->post("sexe");
        $el->datenaissance = $request->post("datenaissance");
        $el->lieu = $request->post("lieu");
        $el->tel = $request->post("tel");
        $el->adresse = $request->post("adresse");
        $el->photo = $request->post("photo");
        $el->email = $request->post("email");
        $el->ville = $request->post("ville");
        $el->pays = $request->post("pays");
        $el->parente_id = $par->id;
        $el->classe_id = $request->post("classe_id");
        $el->save();

        //Add Inscription
        $ins = new Inscription();
        $ins->eleve_id = $el->id;
        $ins->classe_id = $request->post("classe_id");
        $ins->anneescolaire_id = $request->post("annee_id");
        $ins->redoublant = 0;
        $ins->save();

        $qry = 'UPDATE classes SET effectif = effectif + 1 WHERE id LIKE  "'.$ins->classe_id.'" ' ;
        DB::update($qry);

        return response()->json('Added succesfully');
    }

    public function reinscription(Request $request)
    {

        //Add Reinscription
        $ins = new Inscription();
        $ins->eleve_id = $request->post("id");
        $ins->classe_id = $request->post("classe_id");
        $ins->anneescolaire_id = $request->post("annee_id");
        $ins->redoublant = $request->post("redoublant");
        $ins->save();

        $qry = 'UPDATE classes SET effectif = effectif + 1 WHERE id LIKE  "'.$ins->classe_id.'" ' ;
        DB::update($qry);

        $qry2 = 'UPDATE eleves SET classe_id = "'.$ins->classe_id.'" WHERE id LIKE  "'. $ins->eleve_id.'" ' ;
        DB::update($qry2);

        return response()->json('Eleve reinscrit succesfully');
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
        Salle::destroy($id);
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
                //$data = $request->all();
                $data['libelle']=$request->post("libelle");
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
