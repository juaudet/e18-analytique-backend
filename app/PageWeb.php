<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageWeb extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_web';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function historique() {
        $historique = DB::table('pages_web') //PageWeb
                ->join('sites_web', 'sites_web.id', '=', 'pages_web.site_web_id')
                ->join('administrateurs_site', 'administrateurs_site.site_web_id', '=', 'sites_web.id')
                ->join('utilisateurs', 'utilisateurs.id', '=', 'pages_web.utilisateur_id')
                ->where(
                    'administrateurs_site.id', auth()->user()->getSpecificAdminId()
                )
                ->select(
                    'pages_web.*', 
                    'utilisateurs.token as utilisateur_token'
                )
                ->get();
        $historique->each(function ($pageWeb) {
            $pageWeb->utilisateur = array(
                'token' => $pageWeb->utilisateur_token
            );
        });
        return $historique;
    }

}
