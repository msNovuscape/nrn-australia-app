<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    protected $view = 'admin.document.';
    protected $redirect = 'admin/document';

    public function index()
    {
        $settings = Document::orderBy('id','DESC');

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
        $document_categories = DocumentCategory::where('status',1)->get();
        $periods = Period::where('status',1)->get();
        return view($this->view . 'create',compact('document_categories','periods'));
    }

    public function store(Request $request)
    {       
        $this->validate(\request(), [
                'title' => 'required',
                'file' => 'required|file|mimes:pdf',
                'image' => 'file|mimes:jpeg,png,jpg',
                'status' => 'required',
                'document_category' => 'required',
                'period' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['period_id'] = $request['period'];
        $requestData['document_category_id'] = $request['document_category'];

        if($request->hasFile('file')){
            $extension = $request->file('file')->getClientOriginalExtension();
            $image_folder_type = array_search('document',config('custom.image_folders')); //for image saved in folder
            $count = rand(100,999);
            $out_put_path = User::save_image($request->file('file'),$extension,$count,$image_folder_type);
            $image_path1 = is_array($out_put_path) ? $out_put_path[0] : $out_put_path ;;
            $requestData['file'] = $image_path1;
            
        }
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('document',config('custom.image_folders')); //for image saved in folder
            $count = rand(100,999);
            $out_put_path1 = User::save_image($request->file('image'),$extension,$count,$image_folder_type);
            $image_path = is_array($out_put_path1) ? $out_put_path1[0] : $out_put_path1 ;
            $requestData['image'] = $image_path;
        }
        $setting = Document::create($requestData);
        Session::flash('success','Document successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Document::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =Document::findorfail($id);
        $document_categories = DocumentCategory::where('status',1)->get();
        $periods = Period::where('status',1)->get();
        return view($this->view.'edit',compact('setting','document_categories','periods'));
    }

    public function update(Request $request, $id){


        $setting = Document::findorfail($id);
        
        $this->validate(\request(), [
            'title' => 'required',
            'file' => 'file|mimes:pdf',
            'image' => 'file|mimes:jpeg,png,jpg',
            'status' => 'required',
            'document_category' => 'required',
            'period' => 'required'
        ]);

        


        $requestData = $request->all();
        // $requestData['description'] = strip_tags($request['description']);
        $requestData['period_id'] = $request['period'];
        $requestData['document_category_id'] = $request['document_category'];

        if($request->hasFile('file')){
            $extension = $request->file('file')->getClientOriginalExtension();
            $image_folder_type = array_search('document',config('custom.image_folders')); //for image saved in folder
            $count = rand(100,999);
            $out_put_path = User::save_image($request->file('file'),$extension,$count,$image_folder_type);
            $image_path1 = $out_put_path;
            $requestData['file'] = $image_path1;

            if (is_file(public_path().'/'.$setting->file) && file_exists(public_path().'/'.$setting->file)){
                unlink(public_path().'/'.$setting->file);
            }
            
        }
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('document',config('custom.image_folders')); //for image saved in folder
            $count = rand(100,999);
            $out_put_path1 = User::save_image($request->file('image'),$extension,$count,$image_folder_type);
            $image_path = is_array($out_put_path1) ? $out_put_path1[0] : $out_put_path1 ;
            $requestData['image'] = $image_path;

            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }
            
        }
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success', 'Document succesffuly updated.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=Document::findorfail($id);
        
        if($setting->delete()){
            if (is_file(public_path().'/'.$setting->file) && file_exists(public_path().'/'.$setting->file)){
                unlink(public_path().'/'.$setting->file);
            }
            Session::flash('success','Document Category is deleted !');
            return redirect($this->redirect);
        }
        
    }
}
