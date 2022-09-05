<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Setting;
use App\Models\Member;
use App\Models\MembershipType;
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
        $membership_types = MembershipType::where('status',1)->get();
        $settings = $settings->paginate(config('custom.per_page'));
        return view($this->view.'index',compact('settings','membership_types'));
    }

    public function create()
    {
        return view($this->view . 'create');
    }
    public function edit()
    {
        return view($this->view . 'edit');
    }
    public function show($id)
    {
        $member = Member::findorfail($id);
        return view($this->view.'members_info',compact('member'));
    }



    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =MembershipType::findorfail($id);
        $this->validate(\request(), [
            'name' => 'required',
            'amount' => 'nullable',
            'status' => 'required',
        ]);




        $requestData = $request->all();
        $setting->fill($requestData);
        $setting->save();

        Session::flash('success','Membership Type succesffuly edited.');
        return redirect($this->redirect);

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
                $dt = Carbon::now();
                $year = $setting->membership_type->expiration_years;
                $setting->membership_issued_date = Carbon::now();
                if($year != null){
                  $setting->membership_expiry_date = $dt->addYears($year);
                }
                $setting->update();
            }
            return response()->json(['msg' => 'Membership status updated successfully!','membership_status_id' => $setting->membership_status_id],200);
        }


    }
}
