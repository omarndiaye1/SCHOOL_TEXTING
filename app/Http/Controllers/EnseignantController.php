<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Enseignant;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Role;
use App\Models\Role_User;
use App\Service\UserService;
use App\Service\EnseignantService;
class EnseignantController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @param  EnseignantRepository
     * @return void
     */
    public function __construct(EnseignantService $service)
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
        foreach($data as &$value){
              $value->utilisateurs;
          
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
        $us->nom=$request->post("nom");
        $us->prenom=$request->post("prenom");
        $us->sexe=$request->post("sexe");
        $us->datenaissance=$request->post("datenaissance");
        $us->tel=$request->post("tel");
        $us->email=$request->post("email");
        $us->civilite=$request->post("civilite");
        $us->email_verified_at= now();
        $us->save(); 
        $prof=new Enseignant();
       // $prof->matricule=$request->post("matricule");
        $specialite=$request->post("specialite");
        $prof->specialite=$specialite;
        $prof->matricule=$specialite.'00'.$us->id;
       // $prof->specialite="specialite";
        $prof->user_id=$us->id;
        $prof->save();
          //ajout adresse
          $adresse=new Adresse();
          $adresse->libelle=$request->post("libelle");
          $adresse->ville=$request->post("ville");
          $adresse->pays=$request->post("pays");
          $adresse->user_id= $result->id;
          $adresse->save();
          //ajout dans la table d'association
          $role_user=new Role_User();
          $role=new Role();
          $role=Role::whereLibelle($request->post("role"))->firstOrFail();
          $role_user->role_id=$role->id;
          $role_user->user_id= $result->id;
          $role_user->save();
    
        
        return response()->json('Added succesfully');
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
        Enseignant::destroy($id);
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
