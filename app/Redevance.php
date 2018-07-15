<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redevance extends Model
{

   	
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'redevances';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // /**
    //  * Get bannieres.
    //  */
    // public function redevances()
    // {
    //     return $this->hasMany('App\Redevance');
    // }

    // protected $fillable = [
    //     'token',
    //     'cliquee',
    //     'cible',
    //     'montant',
    //     'paiement_redevance_id',
    //     'utilisateur_id',
    //     'date',
    // ];

    // //Do I need to add utilisateur_id ?
    // protected $hidden = ['paiement_redevance_id', 'utilisateur_id'];

    // public static function campagnesAdministrateurConnecte()
    // {
    //     return Redevance::where(
    //             'token', 
    //             auth()->user()->getSpecificAdminId()
    //         )
    //         ->get();
    // }

    // public static function creerRedevance($data) {
    //     return DB::transaction(function () use ($data) {
    //         try {

    //             $redevance = Redevance::create([
    //                 'token' => $data['token'],
    //                 'cliquee' => $data['cliquee'],
    //                 'cible' => $data['cible'],
    //                 'montant' => $data['montant'],
    //                 'utilisateur_id' => $data['utilisateur_id'],
    //             ]);

    //             return $redevance;
    //         }
    //         catch (\Illuminate\Database\QueryException $exception) {
    //             return false;
    //         }
    //     });
    // }
}
