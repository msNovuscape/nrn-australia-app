<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Request;

class HomeController extends Controller
{
    public function indexAdmin()
    {

        if(Auth::check()){
            return view('admin.index');
        }

        return view('admin.login');
    }

    public function getLogin()
    {
        if(Auth::check()){
            return redirect('admin/index');
        }
        return view('admin.login');
    }
    public function postLogin()
    {
        $this->validate(request(),[
            'email'=>'required',
            'password'=>'required',
        ]);
//        dd(\request()->all());



        if (Auth::attempt(['email'=>request('email'),'password'=>request('password')],request()->has('remember'))){
            return redirect('admin/index');
        }
//        Session::flash('success','Invalid Credential!');
        return redirect('login')->withErrors(['Invalid Credentials!']);
    }

    public function admin()
    {
        if(Auth::check()){
            return view('admin.index');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
