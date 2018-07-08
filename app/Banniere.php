<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banniere extends Model
{

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
