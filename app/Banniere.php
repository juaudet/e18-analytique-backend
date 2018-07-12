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

    public static function banniereParAlgorithme($data) {
    	$banniere = Banniere::where('format', $data['format'])->inRandomOrder()->first();
        return $banniere;
    }

    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
