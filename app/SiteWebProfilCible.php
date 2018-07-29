<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteWebProfilCible extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites_web_profil_cible';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'url'
    ];

    protected $hidden = ['profil_cible_id'];

    public static function getProfilCibleFromHistorique($utilisateur) {
        $siteWebProfilCible = DB::table('utilisateurs as u')
                    ->join('pages_web as pw', 'pw.utilisateur_id', 'u.id')
                    ->join('sites_web_profil_cible as sw', 'pw.url', 'like', DB::raw('CONCAT(\'%\', sw.url, \'%\')'))
                    ->join('profils_cible as pc', 'pc.id', 'sw.profil_cible_id')
                    ->where('u.id', $utilisateur->id)
                    ->select('pc.*')
                    ->inRandomOrder()->first();

        return $siteWebProfilCible;
    }

}
