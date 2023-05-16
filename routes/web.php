<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
use App\Http\Controllers\Admin\NewsAndUpdateController;
use App\Http\Controllers\Admin\MembershipTypeController;
use App\Http\Controllers\Admin\EligibilityTypeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\TeamPeriodController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ForgetPasswordController;
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
Route::get('mycron', [HomeAdminController::class,'mycron'])->name('mycron');

Route::get('login', [HomeAdminController::class,'getLogin'])->name('login');
Route::post('login', [HomeAdminController::class,'postLogin']);

Route::get('admin/forget_password',[ForgetPasswordController::class, 'forget_password'])->name('admin.forget_password');
Route::post('admin/forget_password',[ForgetPasswordController::class, 'send_reset_link'])->name('admin.send_reset_link');

Route::get('reset-password/{token}/{email}',[ResetPasswordController::class, 'reset_form'])->name('password.reset');
Route::post('reset-password',[ResetPasswordController::class, 'reset_password']);
Route::get('/images/{d_name}/{year}/{month}/{date}/{file_name}',[HomeAdminController::class,'test_image']);

Route::group(['middleware'=>['auth']],function (){
    //routes for admin
    Route::group(['prefix'=>'admin','middleware' => ['auth']],function (){

        Route::get('/index', [HomeAdminController::class,'indexAdmin']);
        Route::get('logout', [HomeAdminController::class,'getLogout']);

        Route::group(['middleware' => ['can:manage_users']],function (){
            Route::get('users',[UserController::class,'index']);
            Route::get('users/create',[UserController::class,'create']);
            Route::post('users',[UserController::class,'store']);
            Route::get('users/{id}',[UserController::class,'show']);
            Route::get('users/{id}/edit',[UserController::class,'edit']);
            Route::post('users/{id}',[UserController::class,'update']);
            Route::get('users/delete/{id}',[UserController::class,'delete']);
        });

        Route::get('settings',[SettingController::class,'index']);
        Route::get('settings/create',[SettingController::class,'create']);
        Route::post('settings',[SettingController::class,'store']);
        Route::get('settings/{id}',[SettingController::class,'show']);
        Route::get('settings/{id}/edit',[SettingController::class,'edit']);
        Route::post('settings/{id}',[SettingController::class,'update']);
        Route::get('settings/{id}/delete',[SettingController::class,'delete']);

        Route::get('sliders',[SliderController::class,'index']);
        Route::get('sliders/create',[SliderController::class,'create']);
        Route::post('sliders',[SliderController::class,'store']);
        Route::get('sliders/{id}',[SliderController::class,'show']);
        Route::get('sliders/{id}/edit',[SliderController::class,'edit']);
        Route::post('sliders/{id}',[SliderController::class,'update']);
        Route::get('sliders/{id}/delete',[SliderController::class,'delete']);

        Route::get('news',[NewsAndUpdateController::class,'index']);
        Route::get('news/create',[NewsAndUpdateController::class,'create']);
        Route::get('news_type/{news_type}',[NewsAndUpdateController::class,'getNewsDom']);
        Route::post('news',[NewsAndUpdateController::class,'store']);
        Route::get('news/{id}',[NewsAndUpdateController::class,'show']);
        Route::get('news/{id}/edit',[NewsAndUpdateController::class,'edit']);
        Route::get('news_type/{news_type}/{news_id}',[NewsAndUpdateController::class,'getNewsDomEdit']);
        Route::post('news/{id}',[NewsAndUpdateController::class,'update']);
        Route::get('news/{id}/delete',[NewsAndUpdateController::class,'delete']);

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
        Route::post('members/update_status/finance',[MemberController::class,'update_status_by_finance']);
        Route::post('members/update_status/president',[MemberController::class,'update_status_by_president']);
        Route::post('members/{id}',[MemberController::class,'update']);
        Route::get('members/edit/{id}',[MemberController::class,'edit']);
        Route::get('members/delete/{id}',[MemberController::class,'delete']);
        Route::get('members/members_info',[MemberController::class,'members_info']);

        Route::get('gallery',[GalleryController::class,'index']);
        Route::get('gallery/create',[GalleryController::class,'create']);
        Route::post('gallery',[GalleryController::class,'store']);
        Route::get('gallery/{id}',[GalleryController::class,'show']);
        Route::get('gallery/{id}/edit',[GalleryController::class,'edit']);
        Route::post('gallery/{id}',[GalleryController::class,'update']);
        Route::get('gallery/delete/{id}',[GalleryController::class,'delete']);

        Route::get('notices',[NoticeController::class,'index']);
        Route::get('notices/create',[NoticeController::class,'create']);
        Route::post('notices',[NoticeController::class,'store']);
        Route::get('notices/{id}',[NoticeController::class,'show']);
        Route::get('notices/{id}/edit',[NoticeController::class,'edit']);
        Route::post('notices/{id}',[NoticeController::class,'update']);
        Route::get('notices/delete/{id}',[NoticeController::class,'delete']);
        Route::get('notice_type/{notice_type}',[NoticeController::class,'getNoticeDom']);
        Route::get('notice_type/{notice_type}/{notice_id}',[NoticeController::class,'getNoticeDomEdit']);


        Route::get('projects',[ProjectController::class,'index']);
        Route::get('projects/create',[ProjectController::class,'create']);
        Route::post('projects',[ProjectController::class,'store']);
        Route::get('projects/{id}',[ProjectController::class,'show']);
        Route::get('projects/{id}/edit',[ProjectController::class,'edit']);
        Route::post('projects/{id}',[ProjectController::class,'update']);
        Route::get('projects/delete/{id}',[ProjectController::class,'delete']);
        Route::get('project_type/{project_type}',[ProjectController::class,'getProjectDom']);
        Route::get('project_type/{project_type}/{project_id}',[ProjectController::class,'getProjectDomEdit']);

        Route::get('guidelines',[GuidelineController::class,'index']);
        Route::get('guidelines/create',[GuidelineController::class,'create']);
        Route::post('guidelines',[GuidelineController::class,'store']);
        Route::get('guidelines/{id}',[GuidelineController::class,'show']);
        Route::get('guidelines/{id}/edit',[GuidelineController::class,'edit']);
        Route::post('guidelines/{id}',[GuidelineController::class,'update']);
        Route::get('guidelines/delete/{id}',[GuidelineController::class,'delete']);

        Route::get('document_category',[DocumentCategoryController::class,'index']);
        Route::get('document_category/create',[DocumentCategoryController::class,'create']);
        Route::post('document_category',[DocumentCategoryController::class,'store']);
        Route::get('document_category/{id}',[DocumentCategoryController::class,'show']);
        Route::get('document_category/{id}/edit',[DocumentCategoryController::class,'edit']);
        Route::post('document_category/{id}',[DocumentCategoryController::class,'update']);
        Route::get('document_category/delete/{id}',[DocumentCategoryController::class,'delete']);

        Route::get('period',[PeriodController::class,'index']);
        Route::get('period/create',[PeriodController::class,'create']);
        Route::post('period',[PeriodController::class,'store']);
        Route::get('period/{id}',[PeriodController::class,'show']);
        Route::get('period/{id}/edit',[PeriodController::class,'edit']);
        Route::post('period/{id}',[PeriodController::class,'update']);
        Route::get('period/delete/{id}',[PeriodController::class,'delete']);

        Route::get('document',[DocumentController::class,'index']);
        Route::get('document/create',[DocumentController::class,'create']);
        Route::post('document',[DocumentController::class,'store']);
        Route::get('document/{id}',[DocumentController::class,'show']);
        Route::get('document/{id}/edit',[DocumentController::class,'edit']);
        Route::post('document/{id}',[DocumentController::class,'update']);
        Route::get('document/delete/{id}',[DocumentController::class,'delete']);

        Route::get('designation',[DesignationController::class,'index']);
        Route::get('designation/create',[DesignationController::class,'create']);
        Route::post('designation',[DesignationController::class,'store']);
        Route::get('designation/{id}',[DesignationController::class,'show']);
        Route::get('designation/{id}/edit',[DesignationController::class,'edit']);
        Route::post('designation/{id}',[DesignationController::class,'update']);
        Route::get('designation/delete/{id}',[DesignationController::class,'delete']);

        Route::get('team_period',[TeamPeriodController::class,'index']);
        Route::get('team_period/create',[TeamPeriodController::class,'create']);
        Route::post('team_period',[TeamPeriodController::class,'store']);
        Route::get('team_period/{id}',[TeamPeriodController::class,'show']);
        Route::get('team_period/{id}/edit',[TeamPeriodController::class,'edit']);
        Route::post('team_period/{id}',[TeamPeriodController::class,'update']);
        Route::get('team_period/delete/{id}',[TeamPeriodController::class,'delete']);

        Route::get('team',[TeamController::class,'index']);
        Route::get('team/create',[TeamController::class,'create']);
        Route::post('team',[TeamController::class,'store']);
        Route::get('team/{id}',[TeamController::class,'show']);
        Route::get('team/{id}/edit',[TeamController::class,'edit']);
        Route::post('team/{id}',[TeamController::class,'update']);
        Route::get('team/delete/{id}',[TeamController::class,'delete']);

        Route::get('change_password',[AccountController::class,'change_password_form']);
        Route::post('change_password',[AccountController::class,'update_password']);

    });
});
