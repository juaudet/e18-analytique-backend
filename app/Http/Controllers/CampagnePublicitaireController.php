<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CampagnePublicitaire;

class CampagnePublicitaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CampagnePublicitaire::campagnesAdministrateurConnecte();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO
        $request->validate([]);

        $campagnePub = CampagnePublicitaire::creerCampagne($request->all());

        if($campagnePub) {
            return response()->json([
                'message' => 'Success',
                'campagne_pub' => $campagnePub
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /* edition de la campagne de de publicite avant la  mis a jour

     public function edit( $id)
         {

             // TODO
                     $request->validate([]);

                     $campagnePub = CampagnePublicitaire::editCampagne($request->all());

                         $post = Post::where('id', $id)->firstOrFail();
                         return  view ('post-edit', compact('post'));

                         }

                     }

    public function update(Request $request, $id)
    {

        // TODO
                $request->validate([]);

                $campagnePub = CampagnePublicitaire::updateCampagne($request->all());

                return $request->input();
                return response()->json([
                    'message' => 'Success'
                ], 200);

                post = Post::where('id', $id)->firstOrFail(); /* trouve l'entrée en DB */
                $post->update($request->intersect([
                'administrateur_publicite_id' => auth()->user()->getSpecificAdminId(),
                'nom' => $data['nom'],
                'budget' => $data['budget'],
                'date_debut' => $data['date_debut'],
                'date_fin' => $data['date_fin'],
                'active' => $data['active'])); /*récupère les valeurs suivantes */
                return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CampagnePublicitaire::deleteCampagneAdministrateurConnecte($id)) {
            return response()->json([
                'message' => 'Success'
            ], 200);
        }
        return response()->json([
                'message' => 'Not found.',
            ], 404);

    }
}
