<?php

namespace App\Http\Controllers;
use App\ProfilCible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profilsCible = ProfilCible::profilsAdministrateurConnecte();
        return $profilsCible;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'sites_web_profil_cible' => 'required|array',
            'sites_web_profil_cible.*.url' => 'required|max:2000|url',
        ]);

        $profilCible = ProfilCible::creerProfilCible($request->all());

        if($profilCible) {
            return response()->json([
                'message' => 'Success',
                'profil_cible' => $profilCible
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profilCible = ProfilCible::profilParIdAdministrateurConnecte($id);
        if(!$profilCible) {
            return response("Not found", 404);
        }
        return $profilCible;
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
        
        
        $profil = ProfilCible::find($id);
        $profil->nom = $request->input('nom');

        $profil->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProfilCible::destroy($id);
    }
}
