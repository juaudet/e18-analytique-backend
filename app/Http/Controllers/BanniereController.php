<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Banniere;
use App\Utilisateur;

class BanniereController extends Controller
{
    public function getBanniere(Request $request) {

    	$request->validate([
    		'format' => [
    			'required',
    			Rule::in(['horizontal', 'vertical', 'mobile'])
			]
		]);
		
		

		$banniere = Banniere::getBanniereAlgorithme($request->all());
		// $redevance = Redevance::store($request->all());
		
    	if($request->input('struct') == 'json') {
    		return $banniere;
    	}
		return view('banniere', ['banniere' => $banniere]);
	}
}
