<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\SettingResource;
use App\Models\News;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Repositories\Login\LoginRepository;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use Exception;
use App\Models\Member;
use App\Models\Setting;
use App\Repositories\News\NewsRepository;

class HomeController extends ApiBaseController
{
    protected $user;
    private $news;

    public function __construct(NewsRepository $news)
     {
        try{
         $this->user = JWTAuth::parseToken()->authenticate();

        }catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'],401);
            }else{
                return response()->json(['status' => 'Authorization Token not found'],401);
            }
        }
        $this->news = $news;

     }
   public function index(Request $request){
      // GET user token
      $currentUser = JWTAuth::parseToken()->authenticate();

      // Get user id
      $userId = $currentUser['id'];


      // Find member using user id
      $member = Member::where('user_id', $userId)->first();


      $isMember = !(is_null($member) || empty($member));


//      $news = $this->sendResponse($this->news->all($request->all()), 'News fetched successfully');
      $news = News::where('status',1)->get();
      $notice = Notice::where('status',1)->get();
      $settings = Setting::where('status',1)->get();
       return response()->json([
            'sliders' => [
               url('/Carousal.png'),
           url('/Carousal.png'),
           url('/Carousal.png'),
           url('/Carousal.png'),
           url('/Carousal.png'),
           url('/Carousal.png')
               ],
            'news' => NewsResource::collection($news),
            'notices' => null,
            'user' => $currentUser,
            'isMember'=> $isMember,
            'notice' => NoticeResource::collection($notice),
            'settings' => SettingResource::collection($settings),
            'member_image' => $isMember ? url($member->image) : '',

        ], 200);
    }
}
