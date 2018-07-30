<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaiementRedevance extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paiements_redevances';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function redevances() {
        return $this->hasMany('App\Redevance');
    }

    protected $fillable = [
        'no_transaction',
        'date',
        'montant',
        'administrateur_site_id',
    ];

}
