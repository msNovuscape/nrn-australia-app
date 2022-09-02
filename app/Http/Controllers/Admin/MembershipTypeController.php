<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EligibilityType;
use App\Models\MembershipType;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 use function GuzzleHttp\Promise\all;

class MembershipTypeController extends Controller
{
    protected $view = 'admin.membership_type.';
    protected $redirect = 'admin/membership_types';

    public function index()
    {
        $settings = MembershipType::orderBy('id','DESC');

        if(\request('name')){
            $key = \request('name');
            $settings = $settings->where('title','like','%'.$key.'%');
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
        $eligibility_types = EligibilityType::where('status',1)->get();
        return view($this->view . 'create',compact('eligibility_types'));
    }

    public function store(Request $request)
    {       

            $this->validate(\request(), [
                'name' => 'required',
                'amount' => 'required',
                'status' => 'required',
            ]);
        $requestData = $request->all();
        
        $setting = MembershipType::create($requestData);
        $eligibility_type_ids = $request['eligibility_type_ids'] ;
        $setting->eligibility_types()->attach($eligibility_type_ids);
        Session::flash('success','Membership Type successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =MembershipType::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =MembershipType::findorfail($id);
        $eligibility_types = EligibilityType::where('status',1)->get();

        return view($this->view.'edit',compact('setting','eligibility_types'));
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
        $eligibility_type_ids = $request['eligibility_type_ids'] ;
        $setting->eligibility_types()->sync($eligibility_type_ids);
        Session::flash('success','Membership Type succesffuly edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=MembershipType::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Membership Type is deleted !');
            return redirect($this->redirect);
        }
        
    }
}
