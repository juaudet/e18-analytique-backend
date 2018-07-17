<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\AdministrateurPublicite;
use App\AdministrateurSite;
use App\SiteWeb;
use App\Adresse;

// http://jwt-auth.readthedocs.io/en/develop/quick-start/#update-your-user-model
class Administrateur extends Authenticatable implements JWTSubject
{
    

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrateurs';
    
    use Notifiable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    protected $fillable = [
        'nom',
        'password',
        'email',
        'role',
    ];

    public static function createAdministrator($data){

        return DB::transaction(function () use ($data) {
            try {

                $administrateur = Administrateur::create([
                    'nom' => $data['nom'],
                    'password' => Hash::make($data['password']),
                    'email' => strtolower($data['email']),
                    'role' => $data['type'],
                ]);
                
                $adresse = Adresse::create([
                    'no_civique' => $data['no_civique'],
                    'rue' => $data['rue'],
                    'ville' => $data['ville'],
                    'code_postal' => $data['code_postal'],
                    'administrateur_id' => $administrateur->id,
                ]);

                if($data['type'] == 'publicite'){

                    $adminSpec = AdministrateurPublicite::create([
                        'administrateur_id' => $administrateur->id,
                    ]);

                }else if($data['type'] == 'site'){
                    
                    $site_web = SiteWeb::create([
                        'url' => $data['url'],
                    ]);
                   
                    $adminSpec = AdministrateurSite::create([
                        'administrateur_id' => $administrateur->id,
                        'no_compte_bancaire' => $data['no_compte_bancaire'],
                        'site_web_id' => $site_web->id,
                        'token_site' => Str::uuid(),
                    ]);

                }

                return $adminSpec;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $hidden = ['password', 'adresse_id'];

    /**
     * Indicates if the admin has a role.
     *
     * @var string $role the role name
     * @return bool
     */
    public function hasRole($role) {
        return $this->role == $role;
    }

    public function getSpecificAdminId() {
        if(auth()->user()->role == 'site') {
            $adminId = AdministrateurSite::where(
                'administrateur_id', 
                auth()->user()->id
            )->first()->id;
        }
        else {
            $adminId = AdministrateurPublicite::where(
                'administrateur_id', 
                auth()->user()->id
            )->first()->id;
        }
        return $adminId;
    }


}
