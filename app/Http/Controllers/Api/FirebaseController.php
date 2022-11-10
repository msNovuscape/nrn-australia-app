<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Repositories\Register\RegisterRepository;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class FirebaseController extends ApiBaseController
{
    private $register;

    public function __construct(RegisterRepository $register)
    {
        $this->register = $register;
    }

    public function lookup(Request $request){
        $userToken = $request->idToken;
        if(is_null($userToken)){
            return response()->json(['msg' => 'User Token Found'],404);
        }
        $firebase_api_key = config('custom.firebase_api_key');

        $lookup_url = 'https://identitytoolkit.googleapis.com/v1/accounts:lookup?key='.$firebase_api_key;
        // dd($lookup_url);

        $postInput = [
            'idToken' => $userToken,
        ];
  
        $headers = [
            'X-header' => 'value'
        ];
  
        $response = Http::withHeaders($headers)->post($lookup_url, $postInput);
  
        $statusCode = $response->status();
        if($statusCode !== 200){
            return response()->json(['msg','Firebase Token Invalid'],422);
        }
        $responseBody = json_decode($response->getBody(), true);
        // if($responseBody['error']['code'] !== 200){

        // }
        $email = $responseBody['users'][0]['email'];
        $socialId = $responseBody['users'][0]['localId'];
        $displayName = $responseBody['users'][0]['displayName'];
        $user = User::where('social_id',$socialId)->get(); // look for users table with firebase local id
        if($user->count() > 0 ){ //if  found using localId
            return $this->login($user->first());
        } 
        $user = User::where('email', $email)->get();
        if($user->count() > 0){ 
            $requestData['social_id'] = $socialId;
            $user->first()->fill($requestData);
            $user->first()->save();
            return $this->login($user->first());
         }else{
             $password = $this->generateRandomString();
             $request['email'] = $email;
             $request['password'] = $password;
             $request['full_name'] = $displayName;
             $request['social_id'] = $socialId;
             $request['hasUserAgreed'] = true;

            $return = $this->get_register($request);
            return $return;

             // return redirect()->route('get_register',['email' => $email,'password' => $password,'full_name' => $displayName,'social_id' => $socialId]);
            //  $new_user = new User();


         }
        

    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function get_register($request){
        $response = $this->sendResponse($this->register->store($request->all()),'Registered Successfully');
        $data = $response->getData('data')['success'];
        $credentials = $request->only('email', 'password');
        // $request['password'] = bcrypt($request['password']);
        // $user = User::create($request->all());
        // dd($user['password']);
        // $response = $this->sendResponse($this->register->store($attributes),'Registered Successfully');
        // $data = $response->getData('data')['success'];
        // $check = $request->only('email', 'password');

        // dd($check);
        if($data){
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return $this->sendError('Credentials are not valid','401');
                }
            } catch (JWTException $e) {
            // return $attributes;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
            }
            // dd($token);
            return response()->json([
                'success' => true,
                'token' => $token,
            ],200);
        }else{
            $code = 404;
            return $this->sendError('Something went wrong',$code);
        }
    }

    public function login($user){
        // $credentials = $request->only('email');
        // dd($credentials);
        try {
            if (! $token = JWTAuth::fromUser($user)) {
                return $this->sendError('Credentials are not valid','401');
            }
        } catch (JWTException $e) {
    	// return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
        ],200);
        // $response = $this->sendResponse($this->login->login($request->all()),'Loggedin Successfully');
        // $data = $response->getData('data')['data'];
        // if($data){
        //     return $response;

        // }else{
        //     $code = 402;
        //     return $this->sendError('Email or password donot matched',$code);
        // }
    }
}
