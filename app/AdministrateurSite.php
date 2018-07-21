<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdministrateurSite extends Model
{
	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrateurs_site';
    
    protected $fillable = [
        'administrateur_id',
        'no_compte_bancaire',
        'site_web_id',
        'token_site',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    
    public static function getToken($idAdmin){

        $administrateurSite = AdministrateurSite::where('administrateur_id', $idAdmin)->get();
        $tokenSite = $administrateurSite[0]['token_site'];

        return $tokenSite;
    }
}
