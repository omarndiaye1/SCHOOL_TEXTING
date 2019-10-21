<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/utilisateurs/GetLogin/{login}/{password}', 'UserController@GetLogin');
Route::get('/etablissement/nbrEleve', 'EtablissementController@NbreEleve');
Route::get('/aneescholaire/AnEncours', 'AneesholaireController@AnEncours');
Route::get('/etablissement/nbrEleveGarcon', 'EtablissementController@NbreGarcon');
Route::get('/etablissement/nbrEleveFille', 'EtablissementController@NbreFille');
Route::get('/etablissement/nbrClasse', 'EtablissementController@NbreClasse');
Route::get('/etablissement/nbrProf', 'EtablissementController@NbreProf');
Route::get('/etablissement/nbrSms', 'EtablissementController@NbreMessageSend');
Route::get('/etablissement/nbrScientifique', 'EtablissementController@NbreEleveScientifique');
Route::get('/etablissement/nbrLitteraire', 'EtablissementController@NbreEleveLitteraire');
Route::get('/etablissement/HistoriqueParents', 'EtablissementController@HistoriqueMessageParents');
Route::get('/etablissement/HistoriqueProfs', 'EtablissementController@HistoriqueMessageProf');
Route::get('/etablissement/smsgeneral', 'EtablissementController@SMSGENERAL');
Route::post('/message/SendAllTeacher', 'MessageController@store2');
Route::post('/message/SendParent', 'MessageController@smsParent');
Route::post('/message/SendParentByClass', 'MessageController@SendAllParentByClass');
Route::post('/message/SendNoteByClass', 'MessageController@SendNoteParentByClass');
Route::post('/message/SendAllParents', 'MessageController@SendAllParents');
Route::get('/message/Babs/{tel}', 'MessageController@messageBabs');
Route::get('/Classe/showClasse/{id}/{idnivau}','ClasseController@showClasse');
Route::get('/Classe/showClasseWithoutLevel/{idDept}','ClasseController@showClasseWithoutLevel');
Route::get('/eleve/showDetails/{id}','EleveController@showDetails');
Route::get('/Paiement/paiementByMonths/{id}','PaiementController@paiementByMonths');
Route::get('/Paiement/MonthsBypaiement/{id}','PaiementController@MonthsBypaiement');
Route::get('/Scolarite/paiementScolariteByMonths/{id}','ScolariteController@paiementScolariteByMonths');
Route::get('/Scolarite/MonthsBypaiement/{id}','ScolariteController@MonthsBypaiement');
Route::get('/eleve/showDetailsEleve/{idannee}/{idclasse}','EleveController@showDetailsEleve2');
Route::get('/semestre/semestreByYear/{idannee}', 'SemestreController@GetSemestreByAnneeScolaire');
Route::get('/evaluation/evaluationByClasse/{idsemestre}/{idtype}/{idclasse}/{idmat}', 'EvaluationController@GetEvaluation');
Route::get('/evaluation/noteEleveByMatiere/{ideval}/{ideleve}', 'EvaluationController@GetNote');
Route::get('/evaluation/matiereByClasse/{idclasse}', 'EvaluationController@GetEMatiereByClasse');
Route::get('/utilisateurs/sendMail','UserController@sendEmail');
Route::resource('/inscription', 'InscriptionController');
Route::resource('/historiqueparents', 'Historique_parentsController');
Route::resource('/historiqueprofs', 'Historique_profsController');
Route::resource('/role', 'RoleController');
Route::resource('/salle', 'SalleController');
Route::resource('/matiere', 'MatiereController');
Route::resource('/Departement', 'DepartementController');
Route::resource('/Paiement', 'PaiementController');
Route::resource('/Scolarite', 'ScolariteController');
Route::resource('/Mois', 'MoisController');
Route::resource('/Classe', 'ClasseController');
Route::resource('/Niveau', 'NiveauController');
Route::resource('/utilisateurs','UserController');
Route::resource('/Enseignant', 'EnseignantController');
Route::get('/Classe/getNiveaux','NiveauController@getNiveaux');
Route::resource('/etablissement', 'EtablissementController');
Route::resource('/etablissement_adresse', 'Etablissement_adressesController');
Route::resource('/aneescholaire', 'AneesholaireController');
Route::resource('/semestre', 'SemestreController');
Route::resource('/parent', 'ParentController');
Route::resource('/eleve', 'EleveController');
Route::resource('/evaluation', 'EvaluationController');
Route::resource('/note', 'NoteController');
Route::resource('/inscription', 'InscriptionController');
Route::post('/reinscription','InscriptionController@reinscription');
Route::resource('/jour', 'JourController');
Route::resource('/horaire', 'HoraireController');
Route::resource('/cour', 'CourController');
Route::resource('/typeevaluation', 'TypeevaluationController');
Route::resource('/soumatiere', 'SoumatiereController');
Route::get('/Classe/getCour/{id}','ClasseController@getCour');
Route::resource('/classes_matiere', 'Classes_matiereController');
Route::get('/Classe/getmatiere/{id}','ClasseController@getMatiere');
Route::get('/Classe/forBultin/{id}&{id2}','ClasseController@forBultin');
Route::resource('/Bultin', 'BultinController');
Route::resource('/message', 'MessageController');
Route::resource('/messagepredefini', 'Message_predefinisController');
Route::get('/messagepredefini/babs/{id}', 'Message_predefinisController@GetMessagePredefini');

/* Route::get('/roles/create','RoleController@create');
Route::post('/roles/store','RoleController@store');
Route::get('/roles/show/{id}','RoleController@show');
Route::patch('/roles/{id}RoleController@update');
Route::delete('/roles/{id}','RoleController@destroy'); */
