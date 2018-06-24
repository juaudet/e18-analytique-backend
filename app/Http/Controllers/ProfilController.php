<?php

namespace App\Http\Controllers;
use App\ProfilCible;
use Illuminate\Http\Request;

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
            'nom' => 'required|max:255'
        ]);

        $nom = $request->input('nom');
        
        return ProfilCible::create([
            'nom' => $nom,
            'administrateur_publicite_id' => random_int(0, 10), 
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return ProfilCible::find($id);
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
