<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Models\User;
class SendMemberVerifiedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $response = Http::post('Api/v1/send_noti', [
        //     'device_token' => $event->member->device_token,
        //     'title' => 'NRNA Registration',
        //     'body' => 'Congratulations! Your are registered. Soon we will verify you.'
        // ]);
        

       $user_id =  $event->member->user_id;
       $user = User::find($user_id);
       $device_token = $user->device_token;
       $title = 'NRNA Registration';
       $body = 'Congratulations! Your are a verified member.';
       $access_token = $this->get_fcm_access_token();
        if(!is_null($access_token) && !empty($access_token)){
            $headers = array('Content-Type: application/json','Authorization: Bearer ' .$access_token); 
            $data = ['message' => [

                'token' => $device_token,
                 'notification' => [
                     'body' => $body,
                     'title' => $title
                 ]
            ]
                 ];
            {

             }
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/nrna-australia/messages:send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
            $response = curl_exec($ch);
            curl_close($ch);
            $obj =   json_decode($response);
            
            $name =  $obj->name;
            if(isset($name) && !empty($name)){
                return response()->json([
                    'success' => true,
                    'msg' => 'Notification send',
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => 'Bad request. Name cannot be retrieved',
                ],400);
            }
             
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'Failed to get fcm access token',
            ],401);
        }
        

        // Check the response status code
        // if ($response->successful()) {
        //     return true;
        // } else {
        //     return false;
        // }
        // Send a welcome email to the member
        // Mail::to($event->member->email)->send(new WelcomeEmail);
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
         return $access_token;
         
        
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

   

    public function send_noti(Request $request){
       $device_token =  $request['device_token'];
       $body = $request['body'];
       $title = $request['title'];
       $access_token = $this->get_fcm_access_token();
        if(!is_null($access_token) && !empty($access_token)){
            $headers = array('Content-Type: application/json','Authorization: Bearer ' .$access_token); 
            $data = ['message' => [

                'token' => $device_token,
                 'notification' => [
                     'body' => $body,
                     'title' => $title
                 ]
            ]
                 ];
            {

             }
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/nrna-australia/messages:send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
            $response = curl_exec($ch);
            curl_close($ch);
            $obj =   json_decode($response);
            $name =  $obj->name;
            if(isset($name) && !empty($name)){
                return response()->json([
                    'success' => true,
                    'msg' => 'Notification send',
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => 'Bad request. Name cannot be retrieved',
                ],400);
            }
             
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'Failed to get fcm access token',
            ],401);
        }
    }
}
