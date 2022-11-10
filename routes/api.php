<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MembershipTypeController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\EmailVerifyController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\GuidelineController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\FirebaseController;

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
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/register', [RegisterController::class, 'get_register'])->name('get_register');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/send-reset-link', [ResetPasswordController::class,'send_link']);
Route::post('/login/firebase',[FirebaseController::class,'lookup']);


});

Route::group(['namespace' => 'Api' ,'prefix' => 'v1','middleware' => ['jwt.verify']], function() {
    Route::get('home', [HomeController::class, 'index']);
    Route::get('/membership_type', [MembershipTypeController::class, 'index']);
    Route::post('/member', [MemberController::class, 'store']);
    Route::get('/member', [MemberController::class, 'index']);
    Route::get('/member/config', [MemberController::class, 'member_config']);
    Route::get('/member/{phone}', [MemberController::class, 'check_phone']);
    Route::post('/member/send-email/', [EmailVerifyController::class, 'send_mail']);
    Route::post('/member/verify-email/', [EmailVerifyController::class, 'verify']);
    Route::post('/member/is_verified/', [EmailVerifyController::class, 'is_verified']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('news/{id}', [NewsController::class,'show']);
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/notice', [NoticeController::class, 'index']);
    Route::get('notice/{id}', [NoticeController::class,'show']);
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('project/{id}', [ProjectController::class,'show']);
    Route::get('/guidelines', [GuidelineController::class, 'index']);
    Route::get('/document', [DocumentController::class, 'index']);
    Route::get('/team', [TeamController::class, 'index']);

});
