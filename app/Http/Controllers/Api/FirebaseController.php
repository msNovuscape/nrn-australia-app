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
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


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

    public function get_fcm_access_token(){

        // Replace these with your own values
         $service_account_email = 'firebase-adminsdk-n4elu@nrna-australia.iam.gserviceaccount.com';
         $private_key_str = "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC6ttcfsBmkPHYl\nPeK82wUZgVL2ZbhMXXewGith75QrFrMIG2X4Lr/uqK4W3+dPCuSMR9typoJij/eZ\n+Ev4sPqR5SPiYTAfZozIMbC8GgUA+s2h8lyYTNpXSkGVeSDrJvnIiwKsgIvXWfxe\nMgE0oE6j2+tzkn+VD8NaWpGd6zM2LEGJU8nrOJTUQOBA8cNdaTRaAoplTi1aSROQ\nzKExAIcKKzSTkhBcw1IIPpX4xPTbgTaQ98rkEUIjlPBtEJFV4pAjgOJYip0LCfPk\n3e77dhJMZi1pdw/jnlB36A5JTsDi7t1QOjyel6njPTWPre0NAiUokMZa2vtDciGJ\nSb/iOWlRAgMBAAECggEAOfZy2AJ6I1Mlti/9CHXRonZUQ+uWCBboBgJJv3B5hdrZ\nH0YqJJ6WtMcmrDE8BHy0MJxKEtCAH4rj6ad8JisCznHc7vUO1GCoialrXSmSrhgt\n5/1uI1WQXpLNw1JEFtwVpN0KqnSJdQQZZUCOwUCWySWHdWxgMO0gzxbYp7aRQlp3\nm6XRgAHvG5b5I7CEIc5YpJQE/vcbEUYNLZqSYeFIQbKogNekUEapoIYHiPqiBJNP\nsK8wNo+Fjh61p5X/HCfMDi1Na0VMdCcmyylFFbB58LTQluWWmJzzOkdX/X9G8ean\nUzCtAg/AQ/3AKZPOU7YEia2llARoez0q7hV1hF7VRQKBgQD82ifi0stxYlI/Q5sM\njOxWzCVk9yx92qyOf4YR6EcI8OjmrmUyTOhfq0vYVsLmaT+0+Lty0gaUJt3Z/jZ5\n5HyM1OCrPNeGTUV6L+edp0K+WbeJ8DzL75hf942R4KQ1DP2Zuabb7Y7mY47lQYut\n3bm3ZoWd//Qd+XZhh/zWem0wtwKBgQC9CebYfSJ+txMMHMmvzTkGb+VBRsVWwj/K\nV0cWntvq9DdEOafDWXDMWQBhQuduU2LCdbWriUsqb973P67PYOdGXKn1pP7hHqLN\n25Dbuq54IlyuoCtpTzeujSFrP2p7HFlcIHwYxU7yfJkPJYdtbt9u+3t+tBcDWCGM\nDAQmS+WeNwKBgQDCDsRx5wpQuP8aos5KsZVpgEBq3vD8nmm069Z/w99Q02RMNyhf\nlHr7gcIyBVSL9db5E7T5iIuYBMRb3Cj/IAcfJvpPMeDPqFpcTovaiVZGNSER8pkW\ng4pUjO/QN7KPLKst4jhXrljwJRS0irui8vrn8P03qAs5Pg5HCFFaYpeOvQKBgG0O\nOU7LYgsYMrTaJsB09GDyTJ/L5CyZA5QHpcs2+kghe4CwgkgAYUKCVeXGYx0Snfbx\nUU0Ud3iT8V1SL9cTYFkHPEWqWiAlPGbmNDuPBvfnWvCjFmg6ezUH1i+49gTv5d1w\nICdqLJFXsDU8wVQwklXEXwpJer1DKpdQl1RAlMchAoGBAIPrCS9YhqHLC89ilAbh\nAA43wgQlW71lcawhGd+QdlZ+Fhy09+/G3VciZdirBr/2OTzyCO8uUQP6ZZpRkHSl\n0F80PDXPoDwdhs2qaLzK07etkoxUFNVtKfqU9KQ3soHQlzxSK34fRUmPKZ8izUg7\nu0Mz8KmvDmoFIBmh37serNTX\n-----END PRIVATE KEY-----\n";
         $private_key =  str_replace('\n','',$private_key_str);  
         $headers = array(   'Content-Type: application/x-www-form-urlencoded'); 
         $data = array(   'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',   'assertion' => $this->generateJWT($service_account_email, $private_key), ); 
        
         $ch = curl_init(); 
         curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
         $response = curl_exec($ch);
         curl_close($ch); 
        
          $response_data = json_decode($response, true);
         $access_token = $response_data['access_token']; 
         dd($access_token); 
         
        
    }

    function generateJWT($service_account_email, $private_key) {   
        $header = array('alg' => 'RS256',     'typ' => 'JWT',   );   
        $claims = array(     'iss' => $service_account_email,     'scope' => 'https://www.googleapis.com/auth/firebase.messaging',     'aud' => 'https://oauth2.googleapis.com/token',     'exp' => time() + 3600,     'iat' => time(),   );   
        
        return $this->sign($claims,$private_key);
   } 

   function sign($input, $private_key) {  
    $jwt = JWT::encode($input, $private_key, 'RS256');
    return $jwt;
   }


    
    
    
 
}
