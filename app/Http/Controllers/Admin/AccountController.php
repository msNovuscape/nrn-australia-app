<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    protected $view = 'admin.account.';
    // protected $redirect = 'admin/account';


    public function change_password_form(){
        return view($this->view . 'change_password_form');
    }

    public function update_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = auth()->user();
        
        if(Hash::check($request->old_password,$user->password)){

            $user = User::findorfail($user->id);
            if($user->update(['password' => Hash::make($request->password)])){
                return redirect()->back()->with('success','Password is successfully updated.');
            }
        }
        return redirect()->back()->with('success','Your old password is incorrect! Please try again.');


        


    }
}
