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

        $ciblee = false;

        if($data['token']){

            $utilisateur = Utilisateur::getUtilisateur($data['token']);

            if($utilisateur) {
                // récupère l'historique d'un utilisateur et ainsi obtenir ses sitewebprofilcible visité
                $campagneCibleeId = SiteWebProfilCible::getCampagneCibleeId($utilisateur);
                if($campagneCibleeId > 0) {
                    $ciblee = true;
                }
            }
        }

        Redevance::creerRedevance([
            'admin_id' => $data['admin']['id'], 
            'ciblee' => $ciblee
        ]);

        $banniere = Banniere::where('format', $data['format'])->inRandomOrder()->first();

        return $banniere;
    }





    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
