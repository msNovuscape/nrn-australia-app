<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\EligibilityType;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 use function GuzzleHttp\Promise\all;

class EligibilityTypeController extends Controller
{
    protected $view = 'admin.eligibility_type.';
    protected $redirect = 'admin/eligibility_types';

    public function index()
    {
        $settings = EligibilityType::orderBy('id','DESC');

        if(\request('title')){
            $key = \request('title');
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
        return view($this->view . 'create');
    }

    public function store(Request $request)
    {       
        
   
            $this->validate(\request(), [
                'title' => 'required',
                'status' => 'required',
            ]);
        $requestData = $request->all();
        $requestData['title'] = strip_tags($request['title']);
        $setting = EligibilityType::create($requestData);
        Session::flash('success','Eligibility Type successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =EligibilityType::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =EligibilityType::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =EligibilityType::findorfail($id);
        
        $this->validate(\request(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        


        $requestData = $request->all();
        $requestData['title'] = strip_tags($request['title']);
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success','Eligibility Type succesffuly edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=EligibilityType::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Eligibility Type is deleted !');
            return redirect($this->redirect);
        }
        
    }
}
