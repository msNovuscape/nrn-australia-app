<?php

namespace App\Http\Controllers\Api;
use JWTAuth;
use App\Http\Controllers\ApiBaseController;
use App\Repositories\Login\LoginRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends ApiBaseController
{
    private $login;

    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }
    public function login(CreateLoginRequest $request){
        $credentials = $request->only('email', 'password');
        $new_device_token = $request->header('device-token');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->sendError('Credentials are not valid','401');
            }
        } catch (JWTException $e) {
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
        $user = auth()->user();
        $existing_device_token = $user->device_token;
        if(!is_null($new_device_token) && !empty($new_device_token) && $existing_device_token != $new_device_token ){
            $user->device_token = $new_device_token;
            $user->save();
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
