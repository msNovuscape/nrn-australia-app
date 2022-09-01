<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use JWTAuth;

class ApiBaseController extends Controller
{
    public function sendResponse($data, $message, $code = 200)
    {
        
       
        return response()->json([
            'success' => true,
            'data' => $data->get(),
            'message' => $message,
        ], $code);
    }

    public function sendError($error, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], $code);
    }

    public function sendValidationError($error, $code=422)
    {
        return response()->json([
            'message' => 'The given data was invalid',
            'errors' => $error
        ], $code);
    }
}
