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

Route::group([
    'middleware' => ['auth:api', 'role:publicite']
], function ($router) {
	Route::post('profils', 'ProfilController@store');
	Route::get('profils', 'ProfilController@index');
	Route::get('profils/{id}', 'ProfilController@show');
    Route::get('campagnes-publicitaires', 'CampagnePublicitaireController@index');
    Route::post('campagnes-publicitaires', 'CampagnePublicitaireController@store');
    Route::delete('campagnes-publicitaires/{id}', 'CampagnePublicitaireController@destroy');
    Route::patch('profils/{id}', 'ProfilController@update');
    Route::delete('profils/{id}', 'ProfilController@destroy');
});

// Enregistrement
Route::post('register', 'AdministrateurController@store');

// Administrateur
Route::delete('administrateurs/{id}', 'AdministrateurController@destroy');


// http://jwt-auth.readthedocs.io/en/develop/quick-start/#add-some-basic-authentication-routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

