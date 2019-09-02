<?php
header("Access-Control-Allow-Origin: *");
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

Route::resource('/role', 'RoleController');
Route::resource('/salle', 'SalleController');
Route::resource('/matiere', 'MatiereController');
Route::resource('/Departement', 'DepartementController');
Route::resource('/Classe', 'ClasseController');
Route::resource('/Niveau', 'NiveauController');
Route::resource('/Enseignant', 'EnseignantController');
Route::resource('/utilisateurs','UserController');
Route::resource('/Classe', 'ClasseController');
Route::get('/Classe/getNiveaux','NiveauController@getNiveaux');
Route::resource('/etablissement', 'EtablissementController');
/* Route::get('/roles/create','RoleController@create');
Route::post('/roles/store','RoleController@store');
Route::get('/roles/show/{id}','RoleController@show');
Route::patch('/roles/{id}RoleController@update');
Route::delete('/roles/{id}','RoleController@destroy'); */
