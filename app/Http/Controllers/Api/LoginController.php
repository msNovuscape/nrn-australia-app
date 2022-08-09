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
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->sendError('Credentials are not valid','400');
            }
        } catch (JWTException $e) {
    	return $credentials;
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
