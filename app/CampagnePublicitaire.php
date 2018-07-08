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

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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

    protected $hidden = ['administrateur_publicite_id'];

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

                $bannieres = [];
                $bannieres[] = new Banniere([
                    'url' => '',
                    'format' => 'horizontal',
                    'image' => $data['image_horizontale']
                ]);

                $campagnePublicitaire->bannieres()->saveMany($bannieres);

                $campagnePublicitaire->load('bannieres');

                return $campagnePublicitaire;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

}
