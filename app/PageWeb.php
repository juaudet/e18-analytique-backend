<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageWeb extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_web';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
