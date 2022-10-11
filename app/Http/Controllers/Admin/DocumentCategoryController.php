<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DocumentCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentCategoryController extends Controller
{
    protected $view = 'admin.document_category.';
    protected $redirect = 'admin/document_category';

    public function index()
    {
        $settings = DocumentCategory::orderBy('id','DESC');

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
        $setting = DocumentCategory::create($requestData);
        Session::flash('success','Document Category successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =DocumentCategory::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =DocumentCategory::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =DocumentCategory::findorfail($id);
        
        $this->validate(\request(), [
            'title' => 'required',
            // 'description' => 'required',
            'status' => 'required',
        ]);

        


        $requestData = $request->all();
        // $requestData['description'] = strip_tags($request['description']);
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success','Document Category succesffuly edited.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=DocumentCategory::findorfail($id);
        
        if($setting->delete()){
            Session::flash('success','Document Category is deleted !');
            return redirect($this->redirect);
        }
        
    }
}
