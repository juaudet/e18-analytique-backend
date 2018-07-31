<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Utilisateur extends Model
{
	
    public $timestamps = false;

    protected $hidden = ['id', 'token'];


    public static function getUtilisateur($token) {
        $utilisateur = Utilisateur::where('token', $token)->first();
        return $utilisateur;
    }

    public static function creerUtilisateur($data){
        $utilisateur = Utilisateur::create([
            'token' => Str::uuid(),
            'addresse_ip' => $data['addresse_ip']
        ]);
        return $utilisateur;
    }

    /**
     * Historique de navigation pour un utilisateurs
     */
    public static function getHistorique($utilisateur){

        $historique = PageWeb::where('utilisateur_id', '=', $utilisateur['id'])->get();

        return $historique;

    }

    /**
     * Nombre de vue pour un utilisateurs pour tous les sites 
     * confondus
     */
    public static function getNombreVue($utilisateur){

        $nombreVue = PageWeb::where('utilisateur_id', '=', $utilisateur['id'])->count();

        return $nombreVue;
    }

    /**
     * Nombre de clique pour un utilisateurs pour tous les
     * sites confondus.
     */
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
