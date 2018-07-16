<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banniere extends Model
{

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $hidden = ['id', 'campagne_publicitaire_id'];

    public static function getBanniereAlgorithme($data) {

        
        if($data['token']){

            $utilisateur = Utilisateur::getUtilisateur($data['token']);
            
            // récupère l'historique d'un utilisateur et ainsi obtenir ses sitewebprofilcible visité
            $historique = Utilisateur::getHistorique($utilisateur);
      
        }

        
		// $redevance = Redevance::store($request->all());


        $banniere = Banniere::where('format', $data['format'])->inRandomOrder()->first();

        return $banniere;
    }





    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
