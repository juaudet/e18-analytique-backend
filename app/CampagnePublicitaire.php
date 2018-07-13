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
        return CampagnePublicitaire::with('bannieres')->where(
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
                foreach($data['bannieres'] as $banniere) {
                    $bannieres[] = new Banniere([
                        'url' => '',
                        'format' => $banniere['format'],
                        'image' => $banniere['image'],
                    ]);
                }

                foreach($data['profils'] as $profil){
                    $campagnesProfils = CampagnesProfils::createCampagnesProfils($campagnePublicitaire['id'], $profil['id']);
                }

                $campagnePublicitaire->bannieres()->saveMany($bannieres);

                $campagnePublicitaire->load('bannieres');

                return $campagnesProfils;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function deleteCampagneAdministrateurConnecte($id) {
        $campagne = CampagnePublicitaire::where(
                'administrateur_publicite_id', auth()->user()->getSpecificAdminId()
            )
            ->where('id', $id)
            ->first();
        if($campagne) {
            $campagne->delete();
            return true;
        }
        return false;
    }

}
