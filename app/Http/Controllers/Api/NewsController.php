<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\News\NewsRepository;


class NewsController extends ApiBaseController
{
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

        if(\request('per_page')){
            $perpage = request('per_page');
        }else{
            $perpage = config('custom.per_page');
        }
        $settings = News::where('status',1)->orderBy('id','desc')->paginate($perpage);
        return NewsResource::collection($settings);

    }

    public function show($id)
    {
        $setting = News::findOrFail($id);
        return new NewsResource($setting);
    }
//    public function show($id)
//    {
//        return $this->sendResponse($this->news->find($id), 'Single News retrieved successfully');
//    }


}
