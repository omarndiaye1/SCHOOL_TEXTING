<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Parente;
use App\Models\Role;
use App\Models\Role_User;
use App\Service\ParentService;
use Illuminate\Support\Str;


class ParentController  extends BaseControllers
{


    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(ParentService $service)
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
            $value->enfants;
            $value->adresses;
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
        $role=new Role();
        $data = $role->all();
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
        $us->photo= $request->post("photo");
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
        $adresse->libelle=$request->post("adresse");
        $adresse->ville=$request->post("ville");
        $adresse->pays=$request->post("pays");
        $adresse->user_id= $us->id;
        $adresse->save();

        //Ajout dans la table d'association
        $role_user=new Role_User();
        $role=new Role();
        $role=Role::whereLibelle($request->post("role"))->firstOrFail();
        $role_user->role_id=$role->id;
        $role_user->user_id= $us->id;
        $role_user->save();

        // Mail::to($us->email)->send(

        //     new Usercreated($us)
        // );

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
                $data['login']=$request->post("login");
                $data['login']=$request->post("login");
                $data['nom']=$request->post("nom");
                $data['prenom']=$request->post("prenom");
                $data['sexe']=$request->post("sexe");
                $data['datenaissance']=$request->post("datenaissance");
                $data['tel']=$request->post("tel");
                $data['email']=$request->post("email");
                $data['civilite']=$request->post("civilite");
                $data['photo']=$request->post("photo");
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
