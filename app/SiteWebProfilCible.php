<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    protected $hidden = ['profil_cible_id'];

}
