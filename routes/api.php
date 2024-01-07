<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\TeamController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::prefix('teams')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\TeamController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\TeamController::class, 'store']);
        Route::patch('/{id}', [\App\Http\Controllers\Api\TeamController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\TeamController::class, 'destroy']);
        
        Route::prefix('list')->group(function () {
            Route::get('/{id}', [\App\Http\Controllers\Api\TeamController::class, 'players']);
        });
        
        Route::prefix('rankings')->group(function () {
            Route::get('/', [\App\Http\Controllers\Api\TeamController::class, 'rankings']);
        });
    });
    
    Route::prefix('players')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\PlayerController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\PlayerController::class, 'store']);
        Route::patch('/{id}', [\App\Http\Controllers\Api\PlayerController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\PlayerController::class, 'destroy']);
    });
    
    Route::prefix('games')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\GameController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\GameController::class, 'store']);
        Route::patch('/{id}', [\App\Http\Controllers\Api\GameController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\GameController::class, 'destroy']);
    });
});
    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    