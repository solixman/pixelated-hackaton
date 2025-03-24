<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
 public function setRole(Request $request){
    try{
    $user = User::find($request['id']);
    $role=Role::where('name',$request['role'])->first();
    $user->role_id=$role->id;
    $user->save();
    return response()->json('role set succefully');
    }catch(Exception $e){
        return response()->json($e->getMessage());
    }
 }    

}
