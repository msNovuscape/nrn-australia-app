<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Models\VerifyUser;

class EmailVerifyController extends Controller
{
   public function send_mail(Request $request){
    $code = random_int(100000, 999999);
    VerifyUser::create([
        'code' => $code,
        'email' => $request->email
      ]);

      Mail::send('email.email_verification', ['code' => $code], function($message) use($request){
        $message->to($request->email);
        $message->subject('Email Verification Code');
    });  

    return response()->json([
        'success' => true,
    ],200);
   }

   public function verify(Request $request){
       
       $email = $request->email;
       $code = $request->code;

       $verifyUser = VerifyUser::where(['code' => $code,'email' => $email])->first();
       $success = false;
       $msg = "Your code is invalid";
       if(!is_null($verifyUser) ){
           if($verifyUser->is_verified == true)
           {
               $msg = "Email is already verified";
           }else{
            $verifyUser->is_verified = true;
            $verifyUser->save();
           }
           $success = true;
       }
       return response()->json([
        'success' => $success,
        'msg' => $msg,
       ],$success ? 200 : 401);
   }

}
