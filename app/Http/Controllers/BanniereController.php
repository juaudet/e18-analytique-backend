<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Banniere;
use App\AdministrateurSite;

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

	
}
