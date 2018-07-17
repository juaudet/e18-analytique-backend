<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrateurPublicite extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrateurs_publicite';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'administrateur_id',
    ];

    /**
     * Get profils cible.
     */
    public function profilsCible()
    {
        return $this->hasMany('App\ProfilCible');
    }
    
}
