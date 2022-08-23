<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Login\LoginRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
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
    
       return response()->json([
            'sliders' => ['https://api.lorem.space/image?w=375&h=170&q=1',
            'https://api.lorem.space/image?w=375&h=170&q=2',
            'https://api.lorem.space/image?w=375&h=170&q=3',
            'https://api.lorem.space/image?w=375&h=170&q=4',
            'https://api.lorem.space/image?w=375&h=170&q=5',
            'https://api.lorem.space/image?w=375&h=170&q=6'
        ],
            'news' => [
                
                     [
                        'id' => 1,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=1',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 2,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=2',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 3,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=3',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 4,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=4',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 5,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=5',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 6,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=6',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 7,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=7',
                        'publishedAt' => Carbon::now()
                     ],
                     [
                        'id' => 8,
                        'title' => 'Cultural Parade - Nepal Festival Brisbane 2018',
                        'slug' => 'asdf-asdf',
                        'excerpt' => 'Exceprt here',
                        'description' => 'Some description here',
                        'imageUrl' => 'https://api.lorem.space/image?w=375&h=170&q=8',
                        'publishedAt' => Carbon::now()
                     ],
                
                                
            ],
            'notices' => null,
            'isMember'=> false,
        ], 200);
    }
}
