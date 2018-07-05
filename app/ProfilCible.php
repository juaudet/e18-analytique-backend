<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\SiteWebProfilCible;

class ProfilCible extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profils_cible';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function sitesWebProfilCible() {
        return $this->hasMany('App\SiteWebProfilCible');
    }

    protected $fillable = [
        'nom', 'administrateur_publicite_id',
    ];

    protected $hidden = ['administrateur_publicite_id'];

    public static function profilsAdministrateurConnecte()
    {
        return ProfilCible::with('sitesWebProfilCible')
            ->where(
                'administrateur_publicite_id', 
                AdministrateurPublicite::where(
                    'administrateur_id', 
                    auth()->user()->id
                )->first()->id
            )
            ->get();
    }

    public static function profilParIdAdministrateurConnecte($id)
    {
        return ProfilCible::with('sitesWebProfilCible')
                ->where([
                ['administrateur_publicite_id', '=', auth()->user()->getSpecificAdminId()],
                ['id', '=', $id]
            ])
            ->first();
    }

    public static function creerProfilCible($data)
    {
        return DB::transaction(function () use ($data) {
            try {
                $nom = $data['nom'];
                $id_admin = auth()->user()->getSpecificAdminId();

                $profilCible = ProfilCible::create([
                    'nom' => $nom,
                    'administrateur_publicite_id' => $id_admin,
                ]);

                $sitesWeb = [];
                foreach($data['sites_web_profil_cible'] as $siteWeb) {
                    $sitesWeb[] = new SiteWebProfilCible(['url' => $siteWeb['url']]);
                }
                $profilCible->sitesWebProfilCible()->saveMany($sitesWeb);

                $profilCible->load('sitesWebProfilCible');

                return $profilCible;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function deleteProfilCible($id){

        return DB::transaction(function () use ($id){
            try{
                $profilCible = ProfilCible::where('id', $id)->first();

                if($profilCible){
                    
                    return $profilCible->delete();
                }
               
            }catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });

    }

    public static function patchProfilCible(){

        // return DB::transaction(function () use ($data, $id) {
        //     try {
        //         $nom = $data['nom'];
        //         $id_admin = $id;

        //         $profilCible = ProfilCible::find($id);

        //         $profilCible = $nom;


        //         $sitesWeb = [];

        //         foreach($data['sites_web_profil_cible'] as $siteWeb) {

        //             .
        //             $sitesWeb[] = new SiteWebProfilCible(['url' => $siteWeb['url']]);
        //         }

        //         $sitesWebToDelete = sitesWebProfilCible::where('profil_cible_id', $id)->get();

        //         foreach($sitesWebToDelete as $siteWebToDelete){
        //             $siteWebToDelete->delete();
        //         }
                
        //         $profilCible->sitesWebProfilCible()->saveMany($sitesWeb);

        //         $profilCible->load('sitesWebProfilCible');

        //         return $profilCible;
        //     }
        //     catch (\Illuminate\Database\QueryException $exception) {
        //         return false;
        //     }
        // });

    }

}
