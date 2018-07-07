<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected $fillable = [
        'administrateur_publicite_id',
        'nom',
        'budget',
        'date_debut',
        'date_fin',
        'active',
    ];

    public static function campagnesAdministrateurConnecte()
    {
        return CampagnePublicitaire::where(
                'administrateur_publicite_id', 
                auth()->user()->getSpecificAdminId()
            )
            ->get();
    }

    public static function creerCampagne($data) {
        return DB::transaction(function () use ($data) {
            try {

                $campagnePublicitaire = CampagnePublicitaire::create([
                    'administrateur_publicite_id' => auth()->user()->getSpecificAdminId(),
                    'nom' => $data['nom'],
                    'budget' => $data['budget'],
                    'date_debut' => $data['date_debut'],
                    'date_fin' => $data['date_fin'],
                    'active' => $data['active'],
                ]);

                return $campagnePublicitaire;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                var_dump($exception->getMessage());exit;
                return false;
            }
        });
    }

}
