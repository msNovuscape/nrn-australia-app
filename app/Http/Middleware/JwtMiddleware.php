<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            $new_device_token = ($request->header('device-token'));
            $existing_device_token = $user->device_token;
            if(!is_null($new_device_token) && !empty($new_device_token) && $existing_device_token != $new_device_token ){
            $user->device_token = $new_device_token;
            $user->save();
        }
            
        } catch (Exception $e) {
            
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'],401);
            }else{
                \Sentry\captureException($e);
                return response()->json(['status' => 'Authorization Token not found'],401);
            }
        }
        if(!JWTAuth::parseToken()->authenticate()){
            return response()->json(['status' => 'Token is Expired'],401);
        }
        return $next($request);
    }
}
