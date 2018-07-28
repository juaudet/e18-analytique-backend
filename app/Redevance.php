<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Redevance extends Model
{

   	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'redevances';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function getVue(){

        $nombreVue = DB::table('pages_web')
                        ->join('sites_web', 'pages_web.site_web_id', '=', 'sites_web.id')
                        ->join('administrateurs_site', 'administrateurs_site.site_web_id', '=', 'sites_web.id')
                        ->where('administrateurs_site.id', auth()->user()->getSpecificAdminId() )
                        ->count();

        return $nombreVue;
    }

    public static function getProfitTotal(){

        
        $profitTmp = Redevance::selectRaw('sum(montant) as total')
                            ->join('utilisateurs', 'redevances.utilisateur_id', '=', 'utilisateurs.id')
                            ->join('pages_web', 'utilisateurs.id', '=', 'pages_web.utilisateur_id')
                            ->join('sites_web', 'pages_web.site_web_id', '=', 'sites_web.id')
                            ->join('administrateurs_site', 'sites_web.id', '=', 'administrateurs_site.site_web_id')
                            ->where('administrateurs_site.administrateur_id', auth()->user()->id )
                            ->get();
                            
        if($profitTmp[0]->total == null){

            $profitTotaux = 0;
        }else{

            $profitTotaux = $profitTmp[0]->total;
        }

        return $profitTotaux;
    }
    // /**
    //  * Get bannieres.
    //  */
    // public function redevances()
    // {
    //     return $this->hasMany('App\Redevance');
    // }

    // protected $fillable = [
    //     'token',
    //     'cliquee',
    //     'cible',
    //     'montant',
    //     'paiement_redevance_id',
    //     'utilisateur_id',
    //     'date',
    // ];

    // //Do I need to add utilisateur_id ?
    // protected $hidden = ['paiement_redevance_id', 'utilisateur_id'];

    // public static function campagnesAdministrateurConnecte()
    // {
    //     return Redevance::where(
    //             'token', 
    //             auth()->user()->getSpecificAdminId()
    //         )
    //         ->get();
    // }

    // public static function creerRedevance($data) {
    //     return DB::transaction(function () use ($data) {
    //         try {

    //             $redevance = Redevance::create([
    //                 'token' => $data['token'],
    //                 'cliquee' => $data['cliquee'],
    //                 'cible' => $data['cible'],
    //                 'montant' => $data['montant'],
    //                 'utilisateur_id' => $data['utilisateur_id'],
    //             ]);

    //             return $redevance;
    //         }
    //         catch (\Illuminate\Database\QueryException $exception) {
    //             return false;
    //         }
    //     });
    // }
}
