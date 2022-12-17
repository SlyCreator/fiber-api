<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('auth')->group(function (){
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
});
Route::middleware(['auth:api'])->group(function () {
    Route::prefix('user')->group(function (){
        Route::get('/profile',[UserController::class,'profile']);
    });

    Route::prefix('teams')->group(function (){
        Route::get('/',[TeamController::class,'index']);
        Route::post('/',[TeamController::class,'store']);
        Route::prefix('{team_id}')->group(function (){
            Route::get('/',[TeamController::class,'show']);
            Route::patch('/',[TeamController::class,'update']);
            Route::delete('/',[TeamController::class,'destroy']);
        });
    });
});

