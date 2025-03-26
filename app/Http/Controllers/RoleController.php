<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
 
    public static function changeRoleForAll($ids) {
        $users=[];
        $role=Role::where('name','participant')->first();
        // dd($role); 
        foreach($ids as $id){
            $user=User::find($id);
            $user->role()->associate($role);
            // return[$user->role()];
            array_push($users,$user);
        }
        
        return $users;
    }

}
