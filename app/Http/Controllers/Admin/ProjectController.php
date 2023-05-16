<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThirdPartyProject;
use App\Models\NrnaProject;
use App\Models\User;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    protected $view = 'admin.project.';
    protected $redirect = 'admin/projects';

    public function index()
    {
        $settings = Project::where('status',1)->orderBy('id','DESC');

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
                'title' => 'required|string',
                'excerpt' => 'required|string',
                'project_type' => 'required|numeric',
                'image' => 'file|mimes:jpeg,png,jpg',
                'status' => 'required|numeric',
                'publish_date' => 'required|date',
                // 'type' => 'required|numeric',
                'description' => 'required_if:project_type,==,1',
                'url' => 'required_if:project_type,==,2',
            ]);

        if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('project',config('custom.image_folders')); //for image saved in folder
                $count = rand(1000,9999).date('YYYY-mm-dd');
                $directory = User::makeDirectory($image_folder_type);
                $file_name = $count.'project.'.$extension;
                \request()->file('image')->move($directory,$file_name);
                $image_path1 = $directory.$file_name;
            }

        $requestData = $request->all();
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }

        $requestData['slug'] = Setting::create_slug($requestData['title']);

        try{
            DB::beginTransaction();
            //create project
            $setting = new Project();
            $setting->project_type = $requestData['project_type'];
            $setting->excerpt = $requestData['excerpt'] ?? null;
            $setting->image = $requestData['image'] ?? null;
            $setting->slug = $requestData['slug'];
            $setting->status = $requestData['status'];
            $setting->publish_date = $requestData['publish_date'];
            $setting->title = $requestData['title'];
            $setting->type = $requestData['type'] ?? null;
            $setting->save();
            if($setting->project_type == array_search('NRNA',config('custom.project_types'))){
                $nrn_project = new NrnaProject();
                $nrn_project->project_id  = $setting->id;
                $nrn_project->description  = $requestData['description'] ?? null;
                $nrn_project->seo_title  = $requestData['seo_title'];
                $nrn_project->seo_description  = $requestData['seo_description'];
                $nrn_project->keyword  = $requestData['keyword'];
                $nrn_project->meta_keyword  = $requestData['meta_keyword'];
                $nrn_project->image_alt  = $requestData['image_alt'];
                $nrn_project->image_caption  = $requestData['image_caption'];
                $nrn_project->image_credit  = $requestData['image_credit'];
                $nrn_project->save();
            }else{
                $third_party_project = new ThirdPartyProject();
                $third_party_project->project_id = $setting->id;
                $third_party_project->url = $requestData['url'];
                $third_party_project->save();
            }

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

        Session::flash('success','Project successfully created!');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Project::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting = Project::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting =Project::findorfail($id);
        $this->validate(\request(), [
            'title' => 'required|string',
            'project_type' => 'required|numeric',
            'image' => 'file|mimes:jpeg,png,jpg',
            'status' => 'required|numeric',
            'publish_date' => 'required|date',
            // 'type' => 'required|numeric',
            'description' => 'required_if:project_type,==,1',
            'url' => 'required_if:project_type,==,2',
        ]);

        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('project',config('custom.image_folders')); //for image saved in folder
            $count = rand(1000,9999).date('YYYY-mm-dd');
            $directory = User::makeDirectory($image_folder_type);
            $file_name = $count.'project.'.$extension;
            \request()->file('image')->move($directory,$file_name);
            $image_path1 = $directory.$file_name;
        }


        $requestData = $request->all();
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }

        try{
            DB::beginTransaction();
            //update news
            if($setting->project_type == $requestData['project_type']){
                $setting->project_type = $requestData['project_type'];
                $setting->excerpt = $requestData['excerpt'];
                if(isset($requestData['image'])){
                    $setting->image = $requestData['image'];
                }
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                // $setting->type = $requestData['type'];
                $setting->save();
                if($setting->project_type == array_search('NRNA',config('custom.project_types'))){
                    $nrn_project = $setting->nrn_project;
                    $nrn_project->description  = $requestData['description'];
                    $nrn_project->seo_title  = $requestData['seo_title'];
                    $nrn_project->seo_description  = $requestData['seo_description'];
                    $nrn_project->keyword  = $requestData['keyword'];
                    $nrn_project->meta_keyword  = $requestData['meta_keyword'];
                    $nrn_project->image_alt  = $requestData['image_alt'];
                    $nrn_project->image_caption  = $requestData['image_caption'];
                    $nrn_project->image_credit  = $requestData['image_credit'];
                    $nrn_project->save();
                }else{
                    $third_party_project = $setting->third_party_project;
                    $third_party_project->url = $requestData['url'];
                    $third_party_project->save();
                }
            }else{
                if($setting->nrn_project){
                    $setting->nrn_project->delete();
                }
                if($setting->third_party_project){
                    $setting->third_party_project->delete();
                }
                $setting->project_type = $requestData['project_type'];
                $setting->excerpt = $requestData['excerpt'];
                if(isset($requestData['image'])){
                    $setting->image = $requestData['image'];

                }
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                // $setting->type = $requestData['type'];
                $setting->save();
                if($setting->project_type == array_search('NRNA',config('custom.project_types'))){
                    $nrn_project = new NrnaProject();
                    $nrn_project->project_id  = $setting->id;
                    $nrn_project->description  = $requestData['description'];
                    $nrn_project->seo_title  = $requestData['seo_title'];
                    $nrn_project->seo_description  = $requestData['seo_description'];
                    $nrn_project->keyword  = $requestData['keyword'];
                    $nrn_project->image_alt  = $requestData['image_alt'];
                    $nrn_project->image_caption  = $requestData['image_caption'];
                    $nrn_project->image_credit  = $requestData['image_credit'];
                    $nrn_project->save();
                }else{
                    $third_party_project = new ThirdPartyProject();
                    $third_party_project->project_id = $setting->id;
                    $third_party_project->url = $requestData['url'];
                    $third_party_project->save();
                }
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        Session::flash('success','Project successfully updated!');
        return redirect($this->redirect);

    }

            public function delete($id){
                $setting=Project::findorfail($id);
                // if($setting->gallery_images->count() > 0){
                //     $setting->gallery_images()->delete();
                // }
                if($setting->third_party_project){
                    $setting->third_party_project()->delete();
                }
                if($setting->nrn_project){
                    $setting->nrn_project()->delete();
                }

                if($setting->delete()){
                    if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                        unlink(public_path().'/'.$setting->image);
                    }
                }
                Session::flash('success','Project is successfully deleted !');
                return redirect($this->redirect);
            }


            public function getProjectDom($project_type)
            {
                if('NRNA' == config('custom.project_types')[$project_type]){
                    $returnHTML = view($this->view.'nrna_project')->render();// or method that you prefere to return data + RENDER is the key here
                }else{
                    $returnHTML = view($this->view.'third_party_project')->render();// or method that you prefere to return data + RENDER is the key here
                }
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
            public function getProjectDomEdit($project_type,$project_id)
            {
                $setting = Project::findOrFail($project_id);
                if($setting->project_type == $project_type){
                    if('NRNA' == config('custom.project_types')[$project_type]){
                        $returnHTML = view($this->view.'nrna_project',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
                    }else{
                        $returnHTML = view($this->view.'third_party_project',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
                    }
                }else{
                    if('NRNA' == config('custom.project_types')[$project_type]){
                        $returnHTML = view($this->view.'nrna_project')->render();// or method that you prefere to return data + RENDER is the key here
                    }else{
                        $returnHTML = view($this->view.'third_party_project')->render();// or method that you prefere to return data + RENDER is the key here
                    }
                }

                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
}
