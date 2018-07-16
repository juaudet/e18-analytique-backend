<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// http://jwt-auth.readthedocs.io/en/develop/quick-start/#update-your-user-model
class Administrateur extends Authenticatable implements JWTSubject
{
    

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
