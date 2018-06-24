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

Route::post('register', 'RegisterController@create');

Route::post('profils', 'ProfilController@store');
Route::get('profils', 'ProfilController@index');
Route::get('profils/{id}', 'ProfilController@show');
Route::put('profils/{id}', 'ProfilController@update');

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