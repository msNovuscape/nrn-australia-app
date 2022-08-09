<?php

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

Route::group(['namespace' => 'Api' ,'prefix' => 'v1'], function() {
    Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\LoginController::class, 'login']);
});

Route::group(['namespace' => 'Api' ,'prefix' => 'v1','middleware' => ['jwt.verify']], function() {
    Route::get('/home', [\App\Http\Controllers\Api\HomeController::class, 'index']);
});
