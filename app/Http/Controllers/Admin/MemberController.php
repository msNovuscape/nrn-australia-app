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

    public function index($membership_status)
    {
        $membership_status_config = ucfirst($membership_status);
        $index = array_search($membership_status_config,config('custom.membership_status'));
        $per_page = config('custom.per_page');    
        if($index == false){
            Session::flash('error','Membership not found.');
            return redirect($this->redirect);
        }

        $setting = Member::orderBy('id','desc')->where('membership_status_id',$index);

        if(isset($_GET['first_name'])){
            $key = \request('first_name');
            $settings = $setting->where('first_name','like','%'.$key.'%');
        }

        if(isset($_GET['membership_type_id']) && $_GET['membership_type_id'] !=''){
            $key = \request('membership_type_id');
            $settings = $setting->where('membership_type_id',$key);
        }

        if(isset($_GET['state_id']) && $_GET['state_id'] !=''){
            $key = \request('state_id');
            $settings = $setting->where('state_id',$key);
        }
        
        $membership_types = MembershipType::where('status',1)->get();
        $settings = $setting->paginate($per_page);
        return view($this->view.'index',compact('settings','membership_types','membership_status'));
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
                $year_join = Carbon::parse($setting->membership_issued_date)->format('y');
            $month = Carbon::parse($setting->membership_issued_date)->format('m');
            $date = Carbon::parse($setting->membership_issued_date)->format('d');
            $first = strtoupper($setting->first_name[0]);
            $last = strtoupper($setting->last_name[0]);
                $setting->nrna_code = 'NRNA-'.$month . $year_join . $date . str_pad($setting->id, 4, '0', STR_PAD_LEFT) . $first . $last;
                if($year != null){
                  $setting->membership_expiry_date = $dt->addYears($year);
                }
                $setting->update();
            }
            return response()->json(['msg' => 'Membership status updated successfully!','membership_status_id' => $setting->membership_status_id],200);
        }


    }
}
