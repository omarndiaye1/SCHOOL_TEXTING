<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\UserController ;
use App\Models\Enseignant;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Matiere;
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
              $value->utilisateurs->adresses;
              $value->utilisateurs->roles;

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
        $matiere=new Matiere();
        $matiere=Matiere::whereLibelle($request->post("specialite"))->firstOrFail();
        $prof=new Enseignant();
       // $prof->matricule=$request->post("matricule");
        $specialite=$request->post("specialite");
        $prof->specialite=$specialite;
        $prof->matiere_id=$matiere->id;
        $prof->matricule=$specialite.'00'.$us->id;
       // $prof->specialite="specialite";
        $prof->user_id=$us->id;
        $prof->save();
          //ajout adresse
          $adresse=new Adresse();
          $adresse->libelle=$request->post("adresse");
          $adresse->ville=$request->post("ville");
          $adresse->pays=$request->post("pays");
          $adresse->user_id= $us->id;
          $adresse->save();
          //ajout dans la table d'association
          $role_user=new Role_User();
          $role=new Role();
          $role=Role::whereLibelle('Enseignant')->firstOrFail();
          $role_user->role_id=$role->id;
          $role_user->user_id= $us->id;
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
        //User::destroy($id);
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
            //$data = $request->all();
        $matiere=new Matiere();
        $matiere=Matiere::whereLibelle($request->post("specialite"))->firstOrFail();
        //------------------------------------------------//
        $specialite=$request->post("specialite");
        $data['specialite']=$specialite;
        $data['matricule']=$specialite.'00'.$request->post("idU");
        $data['user_id']=$request->post("idU");
        $data['matiere_id']=$matiere->id;
        $res = $this->service->update($data, $id);
        $us=User::find($data['user_id']);
        
        $us->login=$request->post("login");
        $us->nom=$request->post("nom");
        $us->prenom=$request->post("prenom");
        $us->sexe=$request->post("sexe");
        $us->datenaissance=$request->post("datenaissance");
        $us->tel=$request->post("tel");
        $us->email=$request->post("email");
        $us->photo=$request->post("photo");
        $us->civilite=$request->post("civilite");
        $us->email_verified_at= now();
        $us->save();
        //$u=new UserController ();
        //$u->update($request,$request->post("idU"));
        if ($res) {
                return response()->json($res, '201');
            }
       
        } catch (\Exception $e) {
             Log::error($e->getMessage());
                    return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
        }

       

    }
}
