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
        $hachatone->save();
        return response()->json('hackatone created succesfully');
    }
   
    public function delete(Request $request){
        $hackatone = Hackatone::find($request['id']);
        $hackatone->delete();
        return response()->json('hackatone deleted succesfully');
    }

}
