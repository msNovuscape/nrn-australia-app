<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Repositories\Register\RegisterRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRegisterRequest;

class RegisterController extends ApiBaseController
{
    private $register;

    public function __construct(RegisterRepository $register)
    {
        $this->register = $register;
    }
    public function register(CreateRegisterRequest $request){
        
        $response = $this->sendResponse($this->register->store($request->all()),'Registered Successfully');
        $data = $response->getData('data')['data'];
        if($data){
            return $response;
        }else{
            $code = 404;
            return $this->sendError('Something went wrong',$code);
        }
    }
}
