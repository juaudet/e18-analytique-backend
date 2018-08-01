<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Redevance;
use GuzzleHttp\Client;


class RedevanceController extends Controller
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

    public function getRedevanceToPay(){

        $redevance_to_pay = Redevance::getRedevanceToPay();

        if($redevance_to_pay) {
            return response()->json([
                'message' => 'Success',
                'redevance_to_pay' => $redevance_to_pay
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
            ], 500);
    }

    public function payRedevance(Request $request){

        $request->validate([
            'no_compte_bancaire' => 'required|max:255',
        ]);

      
        $response = $this->doTransferWithBankApi($request);
        

        if($response->getStatusCode() == '201'){
            $paiementRedevance = Redevance::payRedevance();
            

            if($paiementRedevance) {
                
                return response()->json([
                    'message' => 'Success',
                    'paiementRedevance' => $paiementRedevance
                ], 201);
            }else{

                return response()->json([
                    'message' => 'Error',
                ], 500);
            }
        }else{

            return response()->json([
                'message' => 'Bad Request',
            ], 400);
        }
        
    }

    private function doTransferWithBankApi(Request $request){

        
        $banque_client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api-nrbanque.herokuapp.com/api/transfert/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        
        $montant = Redevance::where('administrateur_site_id', auth()->user()->getSpecificAdminId() )
                ->where('paiement_redevance_id', null)
                ->sum('montant');

        return $banque_client->request('POST', 'virement', [
            'form_params' => [
                'cpt_prov' => 'NRB00005',
                'cpt_dest' => $request['no_compte_bancaire'],
                'montant' => $montant,
                'cle_api' => '12345',
            ]
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
        //   // TODO
        //   $request->validate([]);

        //   $redevance = Redevance::create($request->all());
  
        //   if($redevance) {
        //       return response()->json([
        //           'message' => 'Success',
        //           'redevance' => $redevance
        //       ], 201);
        //   }
          
        //   return response()->json([
        //           'message' => 'Error',
        //       ], 500);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
