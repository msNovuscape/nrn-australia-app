<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
use App\Http\Controllers\Admin\NewsAndUpdateController;
use App\Http\Controllers\Admin\MembershipTypeController;
use App\Http\Controllers\Admin\EligibilityTypeController;
use App\Http\Controllers\Admin\MemberController;

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
    Route::get('logout', [HomeAdminController::class,'getLogout']);

    //routes for admin
    Route::group(['prefix'=>'admin','middleware' => ['auth']],function (){

        Route::get('/index', [HomeAdminController::class,'indexAdmin']);

        Route::get('news',[NewsAndUpdateController::class,'index']);
        Route::get('news/create',[NewsAndUpdateController::class,'create']);
        Route::post('news',[NewsAndUpdateController::class,'store']);
        Route::get('news/{id}',[NewsAndUpdateController::class,'show']);
        Route::get('news/{id}/edit',[NewsAndUpdateController::class,'edit']);
        Route::post('news/{id}',[NewsAndUpdateController::class,'update']);
        Route::get('news/delete/{id}',[NewsAndUpdateController::class,'delete']);

        Route::get('membership_types',[MembershipTypeController::class,'index']);
        Route::get('membership_types/create',[MembershipTypeController::class,'create']);
        Route::post('membership_types',[MembershipTypeController::class,'store']);
        Route::get('membership_types/{id}',[MembershipTypeController::class,'show']);
        Route::get('membership_types/{id}/edit',[MembershipTypeController::class,'edit']);
        Route::post('membership_types/{id}',[MembershipTypeController::class,'update']);
        Route::get('membership_types/delete/{id}',[MembershipTypeController::class,'delete']);

        Route::get('eligibility_types',[EligibilityTypeController::class,'index']);
        Route::get('eligibility_types/create',[EligibilityTypeController::class,'create']);
        Route::post('eligibility_types',[EligibilityTypeController::class,'store']);
        Route::get('eligibility_types/{id}',[EligibilityTypeController::class,'show']);
        Route::get('eligibility_types/{id}/edit',[EligibilityTypeController::class,'edit']);
        Route::post('eligibility_types/{id}',[EligibilityTypeController::class,'update']);
        Route::get('eligibility_types/delete/{id}',[EligibilityTypeController::class,'delete']);

        Route::get('members',[MemberController::class,'index']);
        // Route::get('members/{id}/',[MemberController::class,'show']);
        Route::post('members/update_status',[MemberController::class,'update_status']);
        // Route::get('members/{id}',[MemberController::class,'show']);
        Route::get('members/{id}',[MemberController::class,'edit']);
        Route::get('members/members_info',[MemberController::class,'members_info']);

    });
});
