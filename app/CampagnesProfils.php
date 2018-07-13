<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CampagnesProfils extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campagnes_profils';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function createCampagnesProfils($campagne_id, $profil_id){

        return DB::transaction(function () use ($campagne_id, $profil_id) {
            try {
                
                $campagnesProfils = CampagnesProfils::create([
                    'campagne_publicitaire_id' => $campagne_id,
                    'profil_cible_id' => $profil_id,
                ]);
        
                $campagnesProfils->save();

                return $campagnesProfils;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });

    }
    
    protected $fillable = [
        'campagne_publicitaire_id',
        'profil_cible_id'
    ];

    protected $hidden = ['profil_cible_id'];
}
