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

        $redevance = Redevance::creerRedevance([
            'admin_id' => $data['admin']['id'], 
            'ciblee' => $ciblee
        ]);

        $banniereQuery = Banniere::where('format', $data['format']);
        if($ciblee) {
            $banniereQuery->where('campagne_publicitaire_id', $campagneCibleeId);
        }

        $banniere = $banniereQuery->inRandomOrder()->first();

        if(!$banniere) {
            $banniere = Banniere::where('format', $data['format'])->inRandomOrder()->first();
        }
        
        $banniere->url = url('/') . "/banniere/clique?redirect_url={$banniere->url}&token_redevance={$redevance->token}";

        return $banniere;
    }





    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
