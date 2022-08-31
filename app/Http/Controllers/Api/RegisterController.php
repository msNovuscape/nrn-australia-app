<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Repositories\Register\RegisterRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRegisterRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class RegisterController extends ApiBaseController
{
    private $register;

    public function __construct(RegisterRepository $register)
    {
        $this->register = $register;
    }
    public function register(CreateRegisterRequest $request){
        
        $response = $this->sendResponse($this->register->store($request->all()),'Registered Successfully');
        $data = $response->getData('data')['success'];
        $credentials = $request->only('email', 'password');
        if($data){
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return $this->sendError('Credentials are not valid','401');
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
        }else{
            $code = 404;
            return $this->sendError('Something went wrong',$code);
        }
    }
}
