<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Member;
use App\Models\News;
use App\Models\Notice;
use Request;

class HomeController extends Controller
{
    public function indexAdmin()
    {

        if (Auth::check()) {
        $pendingMembers = Member::where('membership_status_id', 1)->count();
        $verifiedMembers = Member::where('membership_status_id', 2)->count();
        $rejectedMembers = Member::where('membership_status_id', 3)->count();
        $reapplyMembers = Member::where('membership_status_id', 4)->count();
        $news = News::where('status', 1)->get();
        $notices = Notice::where('status', 1)->get();
            return view(
                'admin.index',
                compact('pendingMembers', 'verifiedMembers', 'rejectedMembers', 'reapplyMembers', 'news', 'notices')
            );
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
