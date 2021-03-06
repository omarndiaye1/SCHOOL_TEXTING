<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Historique_profs;
use App\Models\Enseignant;
use App\Models\User;
use App\Models\Historique_parents;
use App\Models\Parente;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Typeevaluarions;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\Semestre;
use App\Models\Etablissement;
use App\Service\MessageService;
use Informagenie\OrangeSDK;
use \Osms\Osms;
use DB;
class MessageController  extends BaseControllers
{
    	/**
     * Create a new controller instance.
     *
     * @param  NiveauRepository
     * @return void
     */
    public function __construct(MessageService $service)
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
    //   $data = $request->all();
    //   $this->service->create($data);
        //Add Message
         $msg = new Message();
         $msg->titre = $request->post("titre");
         $msg->contenu = $request->post("contenu");
         $msg->save();

         //Add Historique Prof
         $hprof = new Historique_profs();
         $hprof->message_id = $msg->id;
         $prof = new Enseignant();
         $prof = Enseignant::where('id', $request->post("prof_id"))->firstOrFail();
         $hprof->prof_id = $prof->id;
         $user = new User();
         $user = User::where('id', $prof->user_id)->firstOrFail();
         $hprof->save();


         //Send SMS
        $credentials = [
            'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
            'client_secret' => '0cfg1FtD5HAGKkT2'
        ];

        /*
        You can use directly authorization header instead of client_id and client_secret
        $credentials = [
            'authorization_header' => 'Basic xxx...',
        ];
        */

        $sms = new OrangeSDK($credentials);
        $numero = $user->tel;
        $val = 221;
        $tel =  $val.$numero;
        $data = $sms->message($msg->contenu)
            ->from(221771440291)       // Sender phone's number
            ->as('Senschool')      // Sender's name (optional)
            ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
            ->send();
            return response()->json($data, '200');

      //return response()->json('Message send succesfully');


    }


    public function store2(Request $request)
    {
    //   $data = $request->all();
    //   $this->service->create($data);
        //Add Message
         $msg = new Message();
         $msg->titre = $request->post("titre");
         $msg->contenu = $request->post("contenu");
         $msg->save();

         //Add Historique Prof

         foreach($request->post("prof_idtab") as &$value){
            $hprof = new Historique_profs();
            $hprof->message_id = $msg->id;
            $prof = new Enseignant();
            $prof = Enseignant::where('id', $value)->firstOrFail();
            $hprof->prof_id = $prof->id;
            $hprof->save();
            //foreach($request->post("phonetab") as &$value2){
                $user = new User();
                $user = User::where('id', $prof->user_id)->firstOrFail();
            //Send SMS
            $credentials = [
                'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
                'client_secret' => '0cfg1FtD5HAGKkT2'
            ];

            /*
            You can use directly authorization header instead of client_id and client_secret
            $credentials = [
                'authorization_header' => 'Basic xxx...',
            ];
            */

            $sms = new OrangeSDK($credentials);
            $numero = $user->tel;
            $val = 221;
            $tel =  $val.$numero;
            //    $contenu =
            $data = $sms->message($msg->contenu)
                ->from(221771440291)       // Sender phone's number
                ->as('Senschool')      // Sender's name (optional)
                ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
                ->send();
                //return response()->json($data, '200');
            //}

        }
        return response()->json('Message send succesfully');
    }

    public function smsParent(Request $request)
    {
    //   $data = $request->all();
    //   $this->service->create($data);
        //Add Message
         $msg = new Message();
         $msg->titre = $request->post("titre");
         $msg->contenu = $request->post("contenu");
         $msg->save();

         //Add Historique Parent
         $hparent = new Historique_parents();
         $hparent->message_id = $msg->id;
         $parent = new Parente();
         $parent = Parente::where('id', $request->post("parent_id"))->firstOrFail();
         $hparent->parent_id =  $parent->id;
         $hparent->save();
         $user = new User();
         $user = User::where('id', $parent->user_id)->firstOrFail();


         //Send SMS
        $credentials = [
            'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
            'client_secret' => '0cfg1FtD5HAGKkT2'
        ];

        /*
        You can use directly authorization header instead of client_id and client_secret
        $credentials = [
            'authorization_header' => 'Basic xxx...',
        ];
        */

        $sms = new OrangeSDK($credentials);
        $numero = $user->tel;
        $val = 221;
        $tel =  $val.$numero;
        $data = $sms->message($msg->contenu)
            ->from(221771440291)       // Sender phone's number
            ->as('Senschool')      // Sender's name (optional)
            ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
            ->send();
            return response()->json($data, '200');

      //return response()->json('Message send succesfully');


    }

    public function SendAllParentByClass(Request $request)
    {
    //   $data = $request->all();
    //   $this->service->create($data);
        //Add Message
         $msg = new Message();
         $msg->titre = $request->post("titre");
         $msg->contenu = $request->post("contenu");
         $msg->save();

         //Add Historique Parent
         foreach($request->post("parent_idtab") as &$value){
         $hparent = new Historique_parents();
         $hparent->message_id = $msg->id;
         $parent = new Parente();
         $parent = Parente::where('id', $value)->firstOrFail();
         $hparent->parent_id =  $parent->id;
         $hparent->save();

                $user = new User();
                $user = User::where('id', $parent->user_id)->firstOrFail();
            //Send SMS
            $credentials = [
                'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
                'client_secret' => '0cfg1FtD5HAGKkT2'
            ];

            /*
            You can use directly authorization header instead of client_id and client_secret
            $credentials = [
                'authorization_header' => 'Basic xxx...',
            ];
            */

            $sms = new OrangeSDK($credentials);
            $numero = $user->tel;
            $val = 221;
            $tel =  $val.$numero;
            //    $contenu =
            $data = $sms->message($msg->contenu)
                ->from(221771440291)       // Sender phone's number
                ->as('Senschool')      // Sender's name (optional)
                ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
                ->send();
                //return response()->json($data, '200');
            //}

        }
        return response()->json('Message send succesfully');
    }

    public function SendNoteParentByClass(Request $request)
    {
        $etabl = new Etablissement();
        $etabl = Etablissement::where('id', 1)->firstOrFail();

        $eval = new Evaluation();
        $eval = Evaluation::where('id', $request->post("evaluation_id"))->firstOrFail();
         //Get Note Eleve
         foreach($request->post("Eleve_idtab") as &$value){
         $el = new Eleve();
         $el = Eleve::where('id', $value)->firstOrFail();
         $parent = new Parente();
         $parent = Parente::where('id', $el->parente_id)->firstOrFail();
         $user = new User();
         $user = User::where('id', $parent->user_id)->firstOrFail();
         $note = new Note();
         $note = Note::where('evaluation_id', $eval->id)->where('eleve_id', $value)->firstOrFail();
         $sem = new Semestre();
         $sem = Semestre::where('id', $eval->semestre_id)->firstOrFail();
         $typeeval = new Typeevaluarions();
         $typeeval = Typeevaluarions::where('id', $eval->typeevaluarions_id)->firstOrFail();
         $mat = new Matiere();
         $mat = Matiere::where('id', $eval->matiere_id)->firstOrFail();
         $cl = new Classe();
         $cl = Classe::where('id', $eval->classe_id)->firstOrFail();


         //Add Message
         $msg = new Message();
         $msg->titre = ('Note '.$typeeval->libelle.' '.$el->id.$el->nom);
         $msg->contenu = ('Bonjour '.$user->civilite.' '.$user->nom.
                                        ' la note de '.$typeeval->libelle.' de '.$mat->libelle.' du '.$sem->libelle.' Semestre de votre enfant '.$el->nom
                                        .' '.$el->prenom.' en classe de '.$cl->libelleClasse.' est de '.$note->value.'/20 '."\r\n\n"
                                         .' Cordialement '.$etabl->nom.'.');
         $msg->save();

         //Add Historique Parent
         $hparent = new Historique_parents();
         $hparent->message_id = $msg->id;
         $hparent->parent_id = $parent->id;
         $hparent->save();
            //Send SMS
            $credentials = [
                'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
                'client_secret' => '0cfg1FtD5HAGKkT2'
            ];

            /*
            You can use directly authorization header instead of client_id and client_secret
            $credentials = [
                'authorization_header' => 'Basic xxx...',
            ];
            */

            $sms = new OrangeSDK($credentials);
            $numero = $user->tel;
            $val = 221;
            $tel =  $val.$numero;
            //    $contenu =
            $data = $sms->message($msg->contenu)
                ->from(221771440291)       // Sender phone's number
                ->as('Senschool')      // Sender's name (optional)
                ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
                ->send();
                //return response()->json($data, '200');
           // }

        }
        return response()->json('Message send succesfully');
    }

    public function SendAllParents(Request $request)
    {
        //Add Message
        $msg = new Message();
        $msg->titre = $request->post("titre");
        $msg->contenu = $request->post("contenu");
        $msg->save();


         foreach($request->post("Teltab") as &$value){
         $user = new User();
         $user = User::where('id', $value)->firstOrFail();

         //Add Historique Parent
         $hparent = new Historique_parents();
         $hparent->message_id = $msg->id;
         $parent = new Parente();
         $parent = Parente::where('user_id', $user->id)->firstOrFail();
         $hparent->parent_id = $parent->id;
         $hparent->save();
            //Send SMS
            $credentials = [
                'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
                'client_secret' => '0cfg1FtD5HAGKkT2'
            ];

            /*
            You can use directly authorization header instead of client_id and client_secret
            $credentials = [
                'authorization_header' => 'Basic xxx...',
            ];
            */

            $sms = new OrangeSDK($credentials);
            $numero = $user->tel;
            $val = 221;
            $tel =  $val.$numero;
            //    $contenu =
            $data = $sms->message($msg->contenu)
                ->from(221771440291)       // Sender phone's number
                ->as('Senschool')      // Sender's name (optional)
                ->to((int)$tel)      // Recipiant phone's number 773022150 778538538
                ->send();
                //return response()->json($data, '200');
           // }

        }
        return response()->json('Message send succesfully');
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

    public function messageBabs($tel) {
        $credentials = [
            'client_id' => 'UBBqLQPhYHxUm8PWActauCAdTXJnjAjn',
            'client_secret' => '0cfg1FtD5HAGKkT2'
        ];

    /*
       You can use directly authorization header instead of client_id and client_secret
       $credentials = [
           'authorization_header' => 'Basic xxx...',
       ];
     */

    $sms = new OrangeSDK($credentials);
    $numero = $tel;
            $val = 221;
            $telfinal =  $val.$numero;
    $data = $sms->message('Test sms babs')
        ->from(221771440291)       // Sender phone's number
        ->as('Senschool')      // Sender's name (optional)
        ->to((int)$telfinal)      // Recipiant phone's number 773022150 778538538
        ->send();
        return response()->json($data, '200');
    }

    // public function message() {
    //     $config = array(
    //         'token' => 'TkWXITtj3xW6g9cs2w0eyREHeYkB'
    //     );

    //     $osms = new Osms($config);

    //     $senderAddress = 'tel:+221771440291';
    //     $receiverAddress = 'tel:+221771440291';
    //     $message = 'Hello World!';
    //     $senderName = 'Optimus Prime';

    //     $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);
    //     return response()->json($osms, '200');
    // }


}
