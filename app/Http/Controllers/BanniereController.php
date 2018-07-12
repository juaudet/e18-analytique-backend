<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Banniere;

class BanniereController extends Controller
{
    public function fournirBanniere(Request $request) {
    	$request->validate([
    		'format' => [
    			'required',
    			Rule::in(['horizontal', 'vertical', 'mobile'])
    		]
    	]);
    	$banniere = Banniere::banniereParAlgorithme($request->all());
    	if($request->input('struct') == 'json') {
    		return $banniere;
    	}
        return view('banniere', ['banniere' => $banniere]);
    }
}
