<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\HackatoneController;
use App\Http\Controllers\JWTAuthController;
// use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use App\Models\Equipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [JWTAuthController::class, 'register']);
Route::post('/login', [JWTAuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/user', [JWTAuthController::class, 'getUser']);
    Route::post('/logout', [JWTAuthController::class, 'logout']);
});

Route::post('/role/set',[UserController::class,'setRole']);
Route::post('/hackatone/create',[HackatoneController::class,'create']);
Route::post('/hackatone/delete',[HackatoneController::class,'delete']);
Route::post('/hackatone/update',[HackatoneController::class,'update']);
Route::get('/hackatones',[ HackatoneController::class,'showAll' ]);
Route::get('/hackatone/details',[ HackatoneController::class,'showOne' ]);
Route::get('/inscrire',[ HackatoneController::class,'inscrire']);
Route::post('/equipe/create',[ EquipeController::class,'create']);
Route::get('/equipes',[ equipeController::class,'showAll' ]);
Route::post('/equipe/activate',[ equipeController::class,'activate' ]);
