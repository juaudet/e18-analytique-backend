<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Utilisateur;

class StatistiqueController extends Controller
{
    // Obtenir le nombe de vue d'un utilisateur sur l'ensemble des pages web
    public function getVue(){


        // Random pour le moment, mais il faut simplement ajouté le ID dans
        // la requête 
        // $utilisateur = $request['utilisateur'];
        $utilisateur = Utilisateur::inRandomOrder()->first();

        $nombreVue = Utilisateur::getNombreVue($utilisateur);

        if($nombreVue) {
            return response()->json([
                'message' => 'Success',
                'nombreVue' => $nombreVue
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);
    }

    public function getVueByPage($url){

        // Random pour le moment, mais il faut simplement ajouté le ID dans
        // la requête 
        // $utilisateur = $request['utilisateur'];
        $nombreVue = PageWeb::getNombreVue($url);

        if($nombreVue) {
            return response()->json([
                'message' => 'Success',
                'nombreVue' => $nombreVue
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);
    }

    

    public function getClique(){

        
        // $utilisateur = $request['utilisateur'];
        $utilisateur = Utilisateur::inRandomOrder()->first();

        $nombreClique = Utilisateur::getNombreClique($utilisateur);

        if($nombreClique) {
            return response()->json([
                'message' => 'Success',
                'nombreClique' => $nombreClique
            ], 201);
        }else{
            return response()->json([
                'message' => 'Success',
                'nombreClique' => '0'
            ], 201);

        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);
    }
}
