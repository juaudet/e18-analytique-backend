<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrateurSite extends Model
{
	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrateurs_site';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
