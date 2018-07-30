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

    public static function getCampagneCibleeId($utilisateur) {
        $campagnesCiblees = DB::table('utilisateurs as u')
                    ->join('pages_web as pw', 'pw.utilisateur_id', 'u.id')
                    ->join('sites_web_profil_cible as sw', 'pw.url', 'like', DB::raw('CONCAT(\'%\', sw.url, \'%\')'))
                    ->join('profils_cible as pc', 'pc.id', 'sw.profil_cible_id')
                    ->join('campagnes_profils as cp', 'cp.profil_cible_id', 'pc.id')
                    ->where('u.id', $utilisateur->id)
                    ->select('cp.id')
                    ->distinct()
                    ->get();
        if(count($campagnesCiblees) > 0) {
            $campagneCibleeId = $campagnesCiblees[random_int(0, count($campagnesCiblees) - 1)]->id;
        }
        else {
            $campagneCibleeId = 0;
        }

        return $campagneCibleeId;
    }

}
