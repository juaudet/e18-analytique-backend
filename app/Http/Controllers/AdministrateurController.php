<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Administrateur;
use App\AdministrateurPublicite;
use App\AdministrateurSite;
use App\SiteWeb;
use App\Adresse;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdministrateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'url' => 'url'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $type = $request->input('type');
        $administrateur = $this->createAdministrator($request, $type);
        $adresse = $this->createAdresse($request, $administrateur);
        
        try{
            
            $administrateur = $this->createAdministrator($request, $type);
        }catch(\Exception $e){

            return "Email déjà utilisé";
        }
         
        if($type == 'publicite'){
           
            $administrateur_pub = $this->createAdministratorPublicity($request, $administrateur);
        }else if($type == 'site'){

            $site_web = new SiteWeb();
            $administrateur_site = $this->createAdministratorSite($request, $administrateur, 
            $site_web);     
        }else{

            $administrateur->delete();
        }

        return $administrateur;
    }

    
    private function createAdministratorPublicity(Request $request, Administrateur $administrateur){

        $administrateur_pub = new AdministrateurPublicite();
        $administrateur_pub->administrateur_id = $administrateur->id;
        $administrateur_pub->save();
    }

    private function createAdministratorSite(Request $request, Administrateur $administrateur, SiteWeb $site_web){

        $site_web->url = $request->input('url');
        $site_web->save();

        $administrateur_site = new AdministrateurSite();
        $administrateur_site->administrateur_id = $administrateur->id;
        $administrateur_site->no_compte_bancaire = $request->input('no_compte_bancaire');
        $administrateur_site->site_web_id = $site_web->id;
        $administrateur_site->save();
    }
    private function createAdministrator(Request $request, String $type){
        
        $administrateur = new Administrateur();
        $administrateur->nom =  $request->input('nom');
        $administrateur->password = Hash::make($request->input('password'));
        $administrateur->email = $request->input('email');
        $administrateur->role = $type;
        $administrateur->save();

        return $administrateur;
    }

    private function createAdresse(Request $request, Administrateur $administrateur){
        
        $adresse = new Adresse();
        $adresse->no_civique = $request->input('no_civique');
        $adresse->rue =  $request->input('rue');
        $adresse->ville = $request->input('ville');
        $adresse->code_postal = $request->input('code_postal');
        $adresse->administrateur_id = $administrateur->id;
        $adresse->save();

        return $adresse;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = $request->input('type');
        $administrateur = Administrateur::find($id);

        if($type == 'publicite'){


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Administrateur::destroy($id);
        
    }
}
