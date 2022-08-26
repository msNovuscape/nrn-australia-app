<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
use App\Http\Controllers\Admin\NewsAndUpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [HomeAdminController::class,'getLogin'])->name('login');
Route::post('login', [HomeAdminController::class,'postLogin']);
Route::group(['middleware'=>['auth']],function (){
    Route::get('logout', [HomeController::class,'getLogout']);
    //routes for admin
    Route::group(['prefix'=>'admin'],function (){

        Route::get('/index', [HomeAdminController::class,'indexAdmin']);

        Route::get('news',[NewsAndUpdateController::class,'index']);
        Route::get('news/create',[NewsAndUpdateController::class,'create']);
        Route::post('news',[NewsAndUpdateController::class,'store']);
        Route::get('news/{id}',[NewsAndUpdateController::class,'show']);
        Route::get('news/{id}/edit',[NewsAndUpdateController::class,'edit']);
        Route::post('news/{id}',[NewsAndUpdateController::class,'update']);
        Route::get('news/delete/{id}',[NewsAndUpdateController::class,'delete']);

    });
});
