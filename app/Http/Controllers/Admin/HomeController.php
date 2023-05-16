<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Member;
use App\Models\News;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function mycron(){
        Artisan::call('queue:listen');
    }

    public function indexAdmin()
    {

        if (Auth::check()) {

            $roleName = auth()->user()->roles->first()->name;
            if($roleName == 'Treasurer'){
                $pendingMembers = Member::where('payment_status_id', 1)->count();
                $verifiedMembers = Member::where('payment_status_id', 2)->count();
                $rejectedMembers = Member::where('payment_status_id', 3)->count();
                $reapplyMembers = Member::where('payment_status_id', 4)->count();
            }
            if($roleName == 'State Coordinator'){
                $state_id = auth()->user()->state_id;
                $pendingMembers = Member::where('state_id',$state_id)->where('document_status_id', 1)->count();
                $verifiedMembers = Member::where('state_id',$state_id)->where('document_status_id', 2)->count();
                $rejectedMembers = Member::where('state_id',$state_id)->where('document_status_id', 3)->count();
                $reapplyMembers = Member::where('state_id',$state_id)->where('document_status_id', 4)->count();
            }
            if($roleName == 'General Secretary' || $roleName == 'President'){
                $pendingMembers = Member::where('president_status_id', 1)->count();
                $verifiedMembers = Member::where('president_status_id', 2)->count();
                $rejectedMembers = Member::where('president_status_id', 3)->count();
                $reapplyMembers = Member::where('president_status_id', 4)->count();
            }
            if($roleName == 'Super Admin'){
                $pendingMembers = Member::where('membership_status_id', 1)->count();
                $verifiedMembers = Member::where('membership_status_id', 2)->count();
                $rejectedMembers = Member::where('membership_status_id', 3)->count();
                $reapplyMembers = Member::where('membership_status_id', 4)->count();
            }

        $news = News::where('status', 1)->orderBy('created_at', 'desc')->get();
        $notices = Notice::where('status', 1)->orderBy('created_at', 'desc')->get();
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
    public function postLogin(Request $request)
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
