<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}