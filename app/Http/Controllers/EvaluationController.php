<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Evaluation;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Tymon\JWTAuth\Facades\JWTAuth;

class EvaluationController extends Controller
{
    public function store(Request $request){
        $projet = Projet::find($request['id']);
        if(isset($projet->evaluation)){
        return ['message' => 'already evaluated'];
        }
       $user = JWTAuth::parseToken()->authenticate();
       
       $evaluation = new Evaluation();
       $evaluation->comment =$request['comment'];
       $evaluation->score =$request['score'];
          $evaluation->evaluateur()->associate($user);
          $evaluation->projet()->associate($projet);
          $projet->save();
          $evaluation->save();
            return["message"=> "project evaluated"];
      
    }

    public function showResults(){
        $results = DB::table('evaluations')
        ->join('projets','id','=','projet_id')
        // ->join('equipes', 'projets.equipe_id', '=', 'equipes.id')
        ->orderBy('evaluation.score', 'desc')
        ->limit(3)
        ->get();
        return [$results];
    }
    
    
}
