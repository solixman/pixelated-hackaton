<?php

namespace App\Http\Controllers;

use App\Models\Hackatone;
use Illuminate\Http\Request;

class HackatoneController extends Controller
{
    public function create(Request $request){
        $hachatone = new Hackatone();
        $hachatone->title = $request['title'];
        $hachatone->dateDebut = $request['dateDebut'];
        $hachatone->dateFin = $request['dateFin'];
        $hachatone->theme = $request['theme'];
        $hachatone->regles = $request['regles'];
        return response()->json('hackatone created succesfully');
    }
   
}
