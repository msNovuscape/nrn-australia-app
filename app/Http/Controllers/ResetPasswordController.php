<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    protected $view = 'password.';

    public function reset_form($token,$email){
        
        $hashed_token = DB::table('password_resets')->where(['email'=> $email])->first()->token ?? 'random';
        // $hashed_token = PasswordReset::where('email',$email)->first()->token ;
        if(!Hash::check($token,$hashed_token)){
            return 'Link is invalid';
        }
        
        return view($this->view.'reset',compact('token','email'));
    }

    public function reset_password(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                // event(new PasswordReset($user));
            }
        );
        if($status === Password::PASSWORD_RESET){
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            return 'Password changed successfully';
        }
        // $user = User::where('email',$request->email);
        // $password = $request->password;
        // $user->update(['password' => Hash::make($password)]);

         

    }
}
