<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
	
    public $timestamps = false;

    protected $hidden = ['id', 'token'];


    public static function getUtilisateur($token) {

        $utilisateur = Utilisateur::where('token', $token)->inRandomOrder()->first();

        return $utilisateur;
    }

    public static function creerUtilisateur(){

    }

    protected $fillable = [
        'token',
        'addresse_ip'
    ];

}
