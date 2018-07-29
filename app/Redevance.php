<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $profitTotaux = Redevance::where('administrateur_site_id', auth()->user()->getSpecificAdminId() )->sum('montant');

        return $profitTotaux;
    }
    // /**
    //  * Get bannieres.
    //  */
    // public function redevances()
    // {
    //     return $this->hasMany('App\Redevance');
    // }

    protected $fillable = [
        'token',
        'cliquee',
        'ciblee',
        'montant',
        'paiement_redevance_id',
        'administrateur_site_id',
        'date',
    ];

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

    public static function creerRedevance($administrateurSite) {
        return DB::transaction(function () use ($administrateurSite) {
            try {

                $redevance = Redevance::create([
                    'token' => Str::uuid(),
                    'cliquee' => false,
                    'ciblee' => false,
                    'montant' => 0.01,
                    'administrateur_site_id' => $administrateurSite['id'],
                    'paiement_redevance_id' => null,
                    'date' => now()->toDateTimeString()
                ]);

                return $redevance;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }
}
