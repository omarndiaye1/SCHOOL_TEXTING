<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message_predefinis;
use App\Service\Message_predefinisService;
use DB;

class Message_predefinisController  extends BaseControllers
{
   /**
     * Create a new controller instance.
     *
     * @param  MatiereRepository
     * @return void
     */
    public function __construct(Message_predefinisService $service)
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
        $msgPredef = new Message_predefinis();
        $msgPredef->titre = $request->post("titre");
        $msgPredef->contenu = $request->post("contenu");
        $msgPredef->save();
      return response()->json($msgPredef, '201');
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
        Message_predefinis::destroy($id);
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
                // $msgPredef = new Message_predefinis();
                // $msgPredef->titre = $request->post("titre");
                // $msgPredef->contenu = $request->post("contenu");
                $data['titre']=$request->post("titre");
                $data['contenu']=$request->post("contenu");
                $res = $this->service->update($data, $id);
                if ($res) {
                    return response()->json($res, '201');
                }
            } catch (\Exception $e) {
                 Log::error($e->getMessage());
                        return response()->json("Une erreur est survenue lors de la modification, Veuiller contacter l'administrateur",'201');
            }

    }
    public function GetMessagePredefini($id) {
        $qry = "SELECT *
        FROM message_predefinis
        WHERE id = '".$id."' " ;
        $data = DB::select($qry);
        return response()->json($data, '200');
    }


}
