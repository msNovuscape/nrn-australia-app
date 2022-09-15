<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
use App\Http\Controllers\Admin\NewsAndUpdateController;
use App\Http\Controllers\Admin\MembershipTypeController;
use App\Http\Controllers\Admin\EligibilityTypeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\ResetPasswordController;

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

Route::get('reset-password/{token}/{email}',[ResetPasswordController::class, 'reset_form'])->name('password.reset');
Route::post('reset-password',[ResetPasswordController::class, 'reset_password']);

Route::group(['middleware'=>['auth']],function (){

    //routes for admin
    Route::group(['prefix'=>'admin','middleware' => ['auth']],function (){

        Route::get('/index', [HomeAdminController::class,'indexAdmin']);
        Route::get('logout', [HomeAdminController::class,'getLogout']);


        Route::get('news',[NewsAndUpdateController::class,'index']);
        Route::get('news/create',[NewsAndUpdateController::class,'create']);
        Route::get('news_type/{news_type}',[NewsAndUpdateController::class,'getNewsDom']);
        Route::post('news',[NewsAndUpdateController::class,'store']);
        Route::get('news/{id}',[NewsAndUpdateController::class,'show']);
        Route::get('news/{id}/edit',[NewsAndUpdateController::class,'edit']);
        Route::get('news_type/{news_type}/{news_id}',[NewsAndUpdateController::class,'getNewsDomEdit']);
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

        Route::get('members/{membership_status}',[MemberController::class,'index']);
        Route::get('members/show/{id}/',[MemberController::class,'show']);
        Route::post('members/update_status',[MemberController::class,'update_status']);
        Route::post('members/{id}',[MemberController::class,'update']);
        Route::get('members/edit/{id}',[MemberController::class,'edit']);
        Route::get('members/delete/{id}',[MemberController::class,'delete']);
        Route::get('members/members_info',[MemberController::class,'members_info']);

        Route::get('change_password',[AccountController::class,'change_password_form']);
        Route::post('change_password',[AccountController::class,'update_password']);

    });
});
