<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Eleve;
use App\Models\Parente;
use App\Models\Role;
use App\Models\Role_User;
use App\Service\EleveService;
use Illuminate\Support\Str;


class EleveController  extends BaseControllers
{


    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(EleveService $service)
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
        /*foreach($data as &$value){
            $value->utilisateurs;
            $value->enfants;
            $value->adresses;
        }*/
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
        $el->parente_id = $request->post("parent_id");
        $el->classe_id = $request->post("classe_id");
        $el->save();

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
