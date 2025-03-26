<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\UserController;

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
                "members" => $members
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
}
