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

    public function getToken(){

        $idAdmin = auth()->user()->id;

        $token = AdministrateurSite::getToken($idAdmin);

        if($token){
            return response()->json([
                'message' => 'success',
                'token_site' => $token
            ], 201);
        }

        return response()->json([
            'message' => 'error',
        ], 500);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $administrateur = Administrateur::createAdministrator($request->all());

        if($administrateur) {
            return response()->json([
                'message' => 'success',
                'administrateur' => $administrateur
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
