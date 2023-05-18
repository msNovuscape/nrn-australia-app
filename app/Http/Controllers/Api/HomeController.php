<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\SliderResource;
use App\Models\DailyCount;
use App\Models\News;
use App\Models\Notice;
use App\Models\Slider;
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
use Sentry;

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


        $news = News::where('status',1)->get();
        $notice = Notice::where('status',1)->get();
        $settings = Setting::where('status',1)->get();
        // $sliders = Slider::where('status',1)->orderBy('order','asc')->get();


        return response()->json([
                // 'sliders' => SliderResource::collection($sliders),
                'sliders' => [
                    url('/carousel.jpg'),
                    url('/carousel1.png'),
                    url('/carousel2.png'),
                    url('/carousel3.png')
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

    public function userDelete()
    {

        $user = Auth::user();
        $count = DailyCount::dailyCount();
        $user->email_deleted = $user->email;
        $user->email = 'deleted_' . $count->count . '_' . $user->email;
        $user->deleted_date = date('Y-m-d H:i:s');
        $user->is_deleted = 2; //for deleting user
        $user->status = 2; //for deleting user
        $user->device_token = null;
        $user->save();
        return response()->json([
            'message' => 'User has been deleted!',
            'status' => 'ok'
        ], 200);
    }
}
