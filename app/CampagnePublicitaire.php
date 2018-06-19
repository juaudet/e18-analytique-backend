<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampagnePublicitaire extends Model
{
	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campagnes_publicitaires';
    
    const CREATED_AT = 'date_debut';
    const UPDATED_AT = 'date_fin';

    /**
     * Get bannieres.
     */
    public function bannieres()
    {
        return $this->hasMany('App\Banniere');
    }

    public function administrateurPublicite() {
        return $this->hasOne('App\AdministrateurPublicite');
    }

}