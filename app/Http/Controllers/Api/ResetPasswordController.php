<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
   public function send_link(Request $request){
    $request->validate(['email' => 'required|email']);
    $email = $request['email'];
    // $user = User::where('email',$email)->get();

    $status = Password::sendResetLink(
      $request->only('email')
    );
     if(Password::RESET_LINK_SENT === $status){
      return response()->json(['success' => true],200);
     }
     return response()->json(['success' => true],200);
        
    // if($user->isEmpty()){
    //     return response()->json(['success' => true],200);
    // }
    // dd('ok');
    // $token =  md5(rand(1, 10) . microtime());
    // $user->accessToken = $token;
    //     Session::forget('user_id');
    //     Session::forget('token');
    //     Session::put('token',$token);
    //     Session::put('user_id',$user->first()->id);
      //   $details = [

      //       'full_name' => $user->first()->full_name,

      //    'actionURL' => url('/password-reset-form',['token' => Session::get('token')]),


      // ];

        // $user->first()->notify(new ResetPassword($details));
        //   $request->session()->flash('alert-danger', 'Reset link successfully sent.Please check your email!');
          
        //   return redirect()->back();


      }

      
}
