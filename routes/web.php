<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/img', function () {
	$banniere = App\Banniere::find(1);
    return '<img src="data:image/jpeg;base64,' . base64_encode(hex2bin(substr($banniere->image, 2))) . '"/>';
    // return $banniere;
});