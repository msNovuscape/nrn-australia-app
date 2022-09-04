<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Setting;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 use function GuzzleHttp\Promise\all;
 use Carbon\Carbon;

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
        $member = Member::findorfail($id);
        return view($this->view.'members_info',compact('member'));
    }

    public function delete($id){
        $setting=Member::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Member successfully deleted !');
            return redirect($this->redirect);
        }
        
    }

    public function update_status(Request $request){

        $id = $request->id;
        $status = $request->membership_status_id;
        $setting = Member::findorfail($id);
        $previous_status = $setting->membership_status_id;
        
        $setting->membership_status_id = $status;
        if($setting->update()){
            if($previous_status == 1 && $status == 2){
                
                $setting->membership_issued_date = Carbon::now();
                $setting->update();
            }
            return response()->json(['msg' => 'Membership status updated successfully!','membership_status_id' => $setting->membership_status_id],200);
        }
        

    }
}
