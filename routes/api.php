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

Route::get('/message', function (Request $request) {
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json;charset=utf-8");
    return json_encode(array("texte" => "Message de l'API back-end"));
});

Route::get('profil', 'ProfilController@store');

// http://jwt-auth.readthedocs.io/en/develop/quick-start/#add-some-basic-authentication-routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});