<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/tools/search', [ToolController::class, 'search']);
    Route::post('/tools', [ToolController::class, 'store']);
    Route::get('/tools', [ToolController::class, 'index']);
    Route::get('/tools/{tool}', [ToolController::class, 'show']);
    Route::put('/tools/{tool}', [ToolController::class, 'update']);
    Route::delete('/tools/{tool}', [ToolController::class, 'destroy']);
});
