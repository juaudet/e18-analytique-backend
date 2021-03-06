<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Utilisateur;
use App\Redevance;

class StatistiqueController extends Controller
{
    //Renvoi le nombre total de visiteur d'un administrateur
    // de site
    public function getTotalVue(){

        $nombreVue = Redevance::getVue();
  
        if($nombreVue || $nombreVue == 0) {
            return response()->json([
                'message' => 'Success',
                'nombreVue' => $nombreVue
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);

    }

    public function getProfitTotal(){

        $profitTotaux = Redevance::getProfitTotal();

        if($profitTotaux || $profitTotaux == 0){
            return response()->json([
                'message' => 'Success',
                'profitTotaux' => $profitTotaux
            ], 201);
        }

        return response()->json([
            'message' => 'Error',
        ], 500);
    }

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

    
    /**
     * Nombre de clique d'un utilisateur pour tous
     * ses sites confondus
     */
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

    public function getVueByNavigator($siteID, $navigateur){
           
        
        $nombreVue = Utilisateur::getVueByNavigator($siteID, $navigateur);

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


}
