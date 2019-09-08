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
Route::get('/Classe/showClasse/{id}/{idnivau}','ClasseController@showClasse');
Route::get('/eleve/showDetails/{id}','EleveController@showDetails');
Route::resource('/role', 'RoleController');
Route::resource('/salle', 'SalleController');
Route::resource('/matiere', 'MatiereController');
Route::resource('/Departement', 'DepartementController');
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
/* Route::get('/roles/create','RoleController@create');
Route::post('/roles/store','RoleController@store');
Route::get('/roles/show/{id}','RoleController@show');
Route::patch('/roles/{id}RoleController@update');
Route::delete('/roles/{id}','RoleController@destroy'); */
