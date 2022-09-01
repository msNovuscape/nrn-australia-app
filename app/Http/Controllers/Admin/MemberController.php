<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 use function GuzzleHttp\Promise\all;

class MemberController extends Controller
{
    protected $view = 'admin.member.';
    protected $redirect = 'admin/members';

    public function index()
    {
        $settings = Member::orderBy('id','DESC');

        if(\request('name')){
            $key = \request('name');
            $settings = $settings->where('first_name','like','%'.$key.'%');
        }
        if(\request('status')){
            $key = \request('status');
            $settings = $settings->where('status',$key);
        }
        $settings = $settings->paginate(config('custom.per_page'));
        return view($this->view.'index',compact('settings'));
    }

    public function create()
    {
        return view($this->view . 'create');
    }
    public function show($id)
    {
        $setting =Member::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function delete($id){
        $setting=Member::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Member successfully deleted !');
            return redirect($this->redirect);
        }
        
    }
}
