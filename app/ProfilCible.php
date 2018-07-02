<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProfilCible extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profils_cible';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function sitesWebProfilCible() {
        return $this->hasMany('App\SiteWebProfilCible');
    }

    protected $fillable = [
        'nom', 'administrateur_publicite_id',
    ];

    protected $hidden = ['administrateur_publicite_id'];

    public static function profilsAdministrateurConnecte()
    {
        return ProfilCible::with('sitesWebProfilCible')
            ->where(
                'administrateur_publicite_id', 
                AdministrateurPublicite::where(
                    'administrateur_id', 
                    auth()->user()->id
                )->first()->id
            )
            ->get();
    }

}
