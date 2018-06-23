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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Salut';
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
        $liste_url = $request->input('liste_url');

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfilCible  $profilCible
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilCible $profilCible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfilCible  $profilCible
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfilCible $profilCible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfilCible  $profilCible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilCible $profilCible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilCible  $profilCible
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilCible $profilCible)
    {
        //
    }
}
