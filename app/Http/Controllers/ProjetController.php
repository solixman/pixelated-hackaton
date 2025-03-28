<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Projet;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProjetController extends Controller
{
    public function store(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
        if (!isset($user->equipe)) {
            return ['message' => 'dont have a team'];
        }
        $equipe = $user->equipe;
        // return $equipe;

        if (isset($equipe->projet)) {
            return ["message"=> "you already have a project"];
            // $projet = $equipe->projet;
            // $projet->name = $request['name'];
            // $projet->description = $request['description'];
            // $projet->github = $request['github'];
            // $projet->equipe()->associate($equipe);
            // $projet->save();
        } else {

            $projet = new projet();
            $projet->name = $request['name'];
            $projet->description = $request['description'];
            $projet->github = $request['github'];
            $projet->equipe()->associate($equipe);
            $projet->save();
            return ['message' => 'project submited'];
        }
    }

}
