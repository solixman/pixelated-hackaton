<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\UserController;
use App\Models\Projet;

class EquipeController extends Controller
{
    public function create(Request $request)
    {
        $size = 3;
        try {
            if (count($request['ids']) > $size) {
                throw new Exception("a team cant have more than " . $size . " members");
            }

            $members = $this->getMembers($request['ids']);
            // return [ 'members'=>$members];
            $equipe = new Equipe();
            $equipe->name = $request['name'];
            $equipe->save();

            foreach ($members as $member) {
                $member->equipe()->associate($equipe);
                $member->save();
            }
            return [
                "equipe" => $equipe,
                "members" => $equipe->users
            ];
        } catch (Exception $e) {
            return ['message' => $e->getMessage()];
        }
    }

    public function getMembers($ids)
    {
        $members = [];
        $members = RoleController::changeRoleForAll($ids);
        $user = JWTAuth::parseToken()->authenticate();
        array_push($members, $user);
        return $members;
    }


    public function showAll()
    {
        try {
            $equipes = Equipe::all();
            return ['equipes' => $equipes];
        } catch (Exception $e) {
            return ['error' => $e];
        }
    }
    public function validate(Request $request)
    {
        try {
            $equipe = Equipe::find($request['id']);
            $equipe->status='valide';
            $equipe->save();
        } catch (Exception $e) {
            return ['error' => $e];
        }
    }
    public function refuse(Request $request)
    {
        try {
            $equipe = Equipe::find($request['id']);
            $equipe->status='refused';
            $equipe->save();
        } catch (Exception $e) {
            return ['error' => $e];
        }
    }
    public function join(Request $request){
        $size = 3;
        try{
            $user = JWTAuth::parseToken()->authenticate();
            if (isset($user->equipe)){
                throw new exception('you are already in a tream');
            }
            $equipe = Equipe::find($request['id']);
            
            if(count($equipe->users) >= $size){
                throw new exception( 'the team is full, please chose another team or create one');   
            }
            
            $user->equipe()->associate($equipe);
            $user->save();
            
            return[
                'you joined the'.$equipe->name.'succesfully'
            ];
        }
        catch(Exception $e){
            return [
              'error'=> $e->getMessage()
            ];
        }
        
        

    }

    
}
