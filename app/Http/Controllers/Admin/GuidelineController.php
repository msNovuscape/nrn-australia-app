<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Guideline;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 use function GuzzleHttp\Promise\all;

class GuidelineController extends Controller
{
    protected $view = 'admin.guideline.';
    protected $redirect = 'admin/guidelines';

    public function index()
    {
        $settings = Guideline::orderBy('id','DESC');

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
                'description' => 'required',
                'status' => 'required',
            ]);
        $requestData = $request->all();
        $requestData['description'] = $request['description'];
        $setting = Guideline::create($requestData);
        Session::flash('success','Guideline successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Guideline::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =Guideline::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =Guideline::findorfail($id);

        $this->validate(\request(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);




        $requestData = $request->all();
        $requestData['description'] = $request['description'];
        $setting->fill($requestData);
        $setting->save();

        Session::flash('success','Guideline succesffuly edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=Guideline::findorfail($id);

        if($setting->delete()){
            Session::flash('success','Guideline is deleted !');
            return redirect($this->redirect);
        }

    }
}
