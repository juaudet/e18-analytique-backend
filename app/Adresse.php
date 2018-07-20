<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adresses';
    
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'no_civique',
        'administrateur_id',
        'code_postal',
        'ville',
        'rue',
    ];
}
