<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MessageController;
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
            Route::patch('/',[TeamController::class,'update']);//not done
            Route::delete('/',[TeamController::class,'destroy']);//not done

            Route::prefix('members')->group(function (){
                Route::post('/add',[TeamController::class,'addMember']);
                Route::delete('/{memberId}/remove',[TeamController::class,'removeMember']);
            });

            Route::prefix('tasks')->group(function (){
                Route::get('',[TaskController::class,'index']);
                Route::post('',[TaskController::class,'store']);
                Route::prefix('{task_id}')->group(function (){
                    Route::get('',[TaskController::class,'show']);
                    Route::patch('',[TaskController::class,'update']);
                    Route::delete('',[TaskController::class,'destroy']);
                });
            });

            Route::prefix('messages')->group(function(){
                Route::get('/',[MessageController::class,'index']);
                Route::post('/',[MessageController::class,'store']);
                Route::get('/download',[MessageController::class,'show']);
            });
        });
    });


});

