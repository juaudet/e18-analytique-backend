<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Redevance;

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

    public function payRedevance(){

        $paiementRedevance = Redevance::payRedevance();

        if($paiementRedevance) {
            return response()->json([
                'message' => 'Success',
                'paiementRedevance' => $paiementRedevance
            ], 201);
        }
        
        return response()->json([
                'message' => 'Error',
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
