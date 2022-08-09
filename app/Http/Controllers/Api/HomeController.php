<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Login\LoginRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class HomeController extends Controller
{
    protected $user;
 
    public function __construct()
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
        
     }
   public function index(){
    $data = ['https://picsum.photos/200/300?q=2','https://picsum.photos/200/300?q=3','https://picsum.photos/200/300?q=4','https://picsum.photos/200/300?q=5','https://picsum.photos/200/300?q=6','https://picsum.photos/200/300?q=7','https://picsum.photos/200/300?q=8','https://picsum.photos/200/300?q=9','https://picsum.photos/200/300?q=10'];
       return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }
}
