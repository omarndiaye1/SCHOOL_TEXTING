<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Adresse;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Parente;
use App\Models\Role;
use App\Models\Role_User;
use App\Service\EleveService;
use Illuminate\Support\Str;
use DB;

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

        //Add Inscription
        $ins = new Inscription();
        $ins->eleve_id = $el->id;
        $ins->classe_id = $request->post("classe_id");
        $ins->anneescolaire_id = $request->post("annee_id");
        $ins->redoublant = 0;
        $ins->save();

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
    public function showDetails($idParent) {
        $qry = 'SELECT DISTINCT e.id,e.nom,e.prenom,e.datenaissance,e.lieu,cl.libelleClasse FROM parentes p,eleves e,classes cl WHERE e.parente_id LIKE "'.$idParent.'" AND e.classe_id = cl.id ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

    public function showDetailsEleve() {
        $qry = 'SELECT e.id,e.nom,e.prenom,e.sexe,e.email,e.datenaissance,e.lieu,e.adresse,e.ville,e.pays,e.photo,
        cl.id as idClasse,cl.libelleClasse,cl.departement_id, cl.niveau_id,
        p.profession,p.id as parent_id,u.nom as nomparent,u.prenom as prenomparent,u.email as parentemail,u.civilite,u.tel as parentTel,p.tel2,u.photo as parentphoto
        FROM parentes p,eleves e,classes cl,users u WHERE e.parente_id =p.id AND e.classe_id = cl.id AND p.user_id = u.id' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }

    public function showDetailsEleve2($idanne,$idclasse) {
        $qry = 'SELECT e.id,e.nom,e.prenom,e.sexe,e.email,e.datenaissance,e.lieu,e.adresse,e.ville,e.pays,e.photo,
        cl.id as idClasse,cl.libelleClasse,cl.departement_id, cl.niveau_id,
        p.profession,p.id as parent_id,u.nom as nomparent,u.prenom as prenomparent,u.email as parentemail,u.civilite,u.tel as parentTel,p.tel2,u.photo as parentphoto
        FROM parentes p,eleves e,classes cl,users u,inscription i WHERE e.parente_id =p.id AND e.classe_id = cl.id AND p.user_id = u.id AND e.id = i.eleve_id AND i.anneescolaire_id = "'.$idanne.'" AND e.classe_id = "'.$idclasse.'" ' ;
        //$qry = 'SELECT * FROM eleves e ' ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }


}
