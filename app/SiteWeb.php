<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteWeb extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites_web';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
