<?php

namespace App\Http\Controllers;

use App\Models\Hackatone;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\JWTAuthController;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class HackatoneController extends Controller
{
    public function create(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        // return [$user->role->name];
        if ($user->role->name == 'admin' || $user->role->name == 'organisateur') {
            $hackatone = new Hackatone();
            $hackatone->title = $request['title'];
            $hackatone->dateDebut = $request['dateDebut'];
            $hackatone->dateFin = $request['dateFin'];
            $hackatone->theme = $request['theme'];
            $hackatone->regles = $request['regles'];
            $hackatone->save();
            return response()->json('hackatone created succesfully');
        } else {
            return ['message' => 'you are neither an admin nor a organisateur , you cant create a hackatone'];
        }
    }

    public function delete(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role->name == 'admin' || $user->role->name == 'organisateur') {
            $hackatone = Hackatone::find($request['id']);
            $hackatone->delete();
            $user = JWTAuth::parseToken()->authenticate();
        } else {
            return ['message' => 'you are neither an admin nor a organisateur , you cant delete a hackatone'];
        }
    }

    public function update(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role->name == 'admin' || $user->role->name == 'organisateur') {
            $hackatone = Hackatone::find($request['id']);
            $hackatone->title = $request['title'];
            $hackatone->dateDebut = $request['dateDebut'];
            $hackatone->dateFin = $request['dateFin'];
            $hackatone->theme = $request['theme'];
            $hackatone->regles = $request['regles'];
            $hackatone->update();
            return response()->json('hackatone updated succesfully');
        } else {
            return ['message' => 'you are neither an admin nor a organisateur , you cant update a hackatone'];
        }
    }

    public function showAll()
    {
        try {
            $hackatones = Hackatone::all();
            $titles = [];
            foreach ($hackatones as $hackatone) {
                array_push($titles, $hackatone->title);
            }
            return $titles;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function showOne(Request $request)
    {
        try {
            $hackatone = Hackatone::find($request['id']);
            return response()->json($hackatone);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function inscrire(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        dd($user->equipes());
     try {
     
        // if( isset($user->equipe())){
            //inscrire;
        // }
      
     } catch (Exception $e) {
        return ['error'=>$e];
     }
    }
}
