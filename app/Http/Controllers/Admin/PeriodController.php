<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Period;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodController extends Controller
{
    protected $view = 'admin.period.';
    protected $redirect = 'admin/period';

    public function index()
    {
        $settings = Period::orderBy('id','DESC');

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
                'from_date' => 'required',
                'to_date' => 'required',
                'status' => 'required',
            ]);

        $requestData = $request->all();

        $from_date = $requestData['from_date'];
        $to_date = $requestData['to_date'];

        $from_year = date('Y', strtotime($from_date));
        $to_year = date('Y', strtotime($to_date));

        $title = $from_year .'-'.$to_year;
        $requestData['title'] = $title;

        $setting = Period::create($requestData);
        Session::flash('success','Period successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Period::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =Period::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =Period::findorfail($id);
        
        $this->validate(\request(), [
            'from_date' => 'required',
            'to_date' => 'required',
            // 'description' => 'required',
            'status' => 'required',
        ]);

        


        $requestData = $request->all();
        $from_date = $requestData['from_date'];
        $to_date = $requestData['to_date'];

        $from_year = date('Y', strtotime($from_date));
        $to_year = date('Y', strtotime($to_date));

        $title = $from_year .'-'.$to_year;
        $requestData['title'] = $title;
        // $requestData['description'] = strip_tags($request['description']);
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success','Period succesffuly edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=Period::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Period is deleted !');
            return redirect($this->redirect);
        }
        
    }
}
