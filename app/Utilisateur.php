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

    public static function getHistorique($utilisateur){

        $historique = PageWeb::where('utilisateur_id', '=', $utilisateur['id'])->get();

        return $historique;

    }

    public static function getNombreVue($utilisateur){

        $nombreVue = PageWeb::where('utilisateur_id', '=', $utilisateur['id'])->count();

        return $nombreVue;
    }

    public static function getNombreClique($utilisateur){

        $nombreClique = Redevance::where('utilisateur_id', '=', $utilisateur['id'])
                                ->where('cliquee', '=', 'true')->count();

        return $nombreClique;
    }

    protected $fillable = [
        'token',
        'addresse_ip'
    ];

}
