<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;

class ForgetPasswordController extends Controller
{
   public function forget_password(){
       return view('admin.forget_password_form');
   }

   public function send_reset_link(Request $request){
    $request->validate(['email' => 'required|email']);
    $email = $request['email'];
    $user = User::where('is_admin',true)->where('email',$email);
    
    if($user->count() > 0){
        $status = Password::sendResetLink(
            $request->only('email')
          );
           if(Password::RESET_LINK_SENT === $status){
            Redirect::back()->with(['success' => 'Password reset link is successfully sent to '.$user->first()->email]);
           }
           return redirect()->back()->withErros(['msg' => 'Email could not be sent.Please try again.']);
    }
    return Redirect::back()->withErrors(['msg' => 'Invalid email! Please enter your registered email.']); 
    
}
}