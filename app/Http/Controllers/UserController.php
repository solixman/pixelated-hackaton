<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
 public function setRole(Request $request){
    $user = User::find($request['id']);
    $user->role_id=Role::where('name',$request['role']);
    return response()->json('role set succesfully');
 }    

}
