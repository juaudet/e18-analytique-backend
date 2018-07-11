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
        return response('<img src="' . $banniere->image . '" alt="" />');
    }

    protected $fillable = [
        'url',
        'format',
        'image'
    ];

}
