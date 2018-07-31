<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Banniere;
use App\AdministrateurSite;
use App\Redevance;

class BanniereController extends Controller
{
    public function getBanniere(Request $request) {

    	$request->validate([
    		'format' => [
    			'required',
    			Rule::in(['horizontal', 'vertical', 'mobile'])
			]
		]);
		
		$administrateurSite = AdministrateurSite::where('token_site', $request->token)->first();

		$banniere = Banniere::getBanniereAlgorithme([
			'format' => $request->input('format'),
			'token' => $request->cookie('token'),
			'admin' => $administrateurSite
		]);
		
		
    	if($request->input('struct') == 'json') {
    		return $banniere;
		}
		
		return view('banniere', ['banniere' => $banniere]);
	}

	public function banniereCliquee(Request $request) {

		$request->validate([
    		'token_redevance' => 'required',
    		'redirect_url' => 'required',
		]);

		$redevance = Redevance::getRedevanceByToken([
			'token' => $request->input('token_redevance'),
		]);

		if(is_null($redevance)) {
			return response()->json('Not Found.', 404);
		}

		$redevance->setClique();

		return redirect()->away($request->input('redirect_url'));
	}

	
}
