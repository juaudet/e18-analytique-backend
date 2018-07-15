<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\SiteWeb;

class PageWeb extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_web';

    protected $fillable = [
        'utilisateur_id',
        'url',
        'date_visite',
        'navigateur',
        'site_web_id',
    ];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function creerPageWeb($data) {
        return DB::transaction(function () use ($data) {
            try {
                $siteWeb = SiteWeb::getSiteWebFromAdminSiteToken($data['token_site']);
                $pageWeb = PageWeb::create([
                    'utilisateur_id' => $data['utilisateur']['id'],
                    'url' => $data['url'],
                    'date_visite' => now()->toDateTimeString(), // https://stackoverflow.com/a/32720098
                    'navigateur' => $data['navigateur'],
                    'site_web_id' => is_null($siteWeb) ? 0 : $siteWeb->id
                ]);
                return $pageWeb;
            }
            catch (\Illuminate\Database\QueryException $exception) {
                return false;
            }
        });
    }

    public static function historique() {
        $historique = DB::table('pages_web') //PageWeb
                ->join('sites_web', 'sites_web.id', '=', 'pages_web.site_web_id')
                ->join('administrateurs_site', 'administrateurs_site.site_web_id', '=', 'sites_web.id')
                ->join('utilisateurs', 'utilisateurs.id', '=', 'pages_web.utilisateur_id')
                ->where(
                    'administrateurs_site.id', auth()->user()->getSpecificAdminId()
                )
                ->select(
                    'pages_web.*', 
                    'utilisateurs.token as utilisateur_token'
                )
                ->get();
        $historique->each(function ($pageWeb) {
            $pageWeb->utilisateur = array(
                'token' => $pageWeb->utilisateur_token
            );
        });
        return $historique;
    }

    public static function getVueByPage($url){

        $nombreVue = PageWeb::where('url','=',$url)->count();

        return nombreVue;
    }

    public static function getVueByEntireWebSite($siteID){

        $nombreVue = PageWeb::where('site_web_id','=', $siteID)->count();
        
        return $nombreVue;
    }

    /**
     * Il faut définir la valeur que devrait avoir $navigateur,
     * peut-être faire un subString pour avoir juste le début, etc..
     */
    public static function getVueByNavigator($siteID, $navigateur){

        $nombreVue = PageWeb::where('site_web_id', '=', $siteID)
                            ->where('navigateur', '=', $navigateur)
                            ->count();

        return $nombreVue;
    }

}
