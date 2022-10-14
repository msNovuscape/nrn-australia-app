<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Designation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    protected $view = 'admin.designation.';
    protected $redirect = 'admin/designation';

    public function index()
    {
        $settings = Designation::orderBy('id','DESC');

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
                // 'description' => 'required',
                'status' => 'required',
            ]);
        $requestData = $request->all();
        // $requestData['description'] = strip_tags($request['description']);
        $setting = Designation::create($requestData);
        Session::flash('success','Designation successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Designation::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =Designation::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

        $setting =Designation::findorfail($id);
        
        $this->validate(\request(), [
            'title' => 'required',
            'status' => 'required',
        ]);

        $requestData = $request->all();
        // $requestData['description'] = strip_tags($request['description']);
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success','Designation successfully edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting = Designation::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Designation is successfully deleted !');
            return redirect($this->redirect);
        }
        
    }
}
