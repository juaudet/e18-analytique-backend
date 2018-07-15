<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteWeb extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites_web';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function getSiteWebFromAdminSiteToken($token) {
        $siteWeb =  DB::table('sites_web')
                ->join('administrateurs_site', 'administrateurs_site.site_web_id', '=', 'sites_web.id')
                ->where('administrateurs_site.token_site', $token)
                ->select(
                    'sites_web.id'
                )
                ->first();
        return $siteWeb;
    }
}
