<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\ThirdPartyNotice;
use App\Models\NrnaNotice;
use App\Models\NoticeImage;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NoticeController extends Controller
{
    protected $view = 'admin.notice.';
    protected $redirect = 'admin/notices';

    public function index()
    {
        $settings = Notice::orderBy('id','DESC');

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
                'news_type' => 'required|numeric',
                'image' => 'file|mimes:jpeg,png,jpg',
                'status' => 'required|numeric',
                'publish_date' => 'required|date',
                // 'type' => 'required|numeric',
                'description' => 'required_if:news_type,==,1',
                'url' => 'required_if:news_type,==,2',
            ]);

        if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('notice',config('custom.image_folders')); //for image saved in folder
                $count = rand(1000,9999).date('YYYY-mm-dd');
                $directory = User::makeDirectory($image_folder_type);
                $file_name = $count.'notice.'.$extension;
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
            //create news
            $setting = new Notice();
            $setting->notice_type = $requestData['news_type'];
            $setting->excerpt = $requestData['excerpt'] ?? null;
            $setting->image = $requestData['image'] ?? null;
            $setting->slug = $requestData['slug'];
            $setting->status = $requestData['status'];
            $setting->publish_date = $requestData['publish_date'];
            $setting->title = $requestData['title'];
            $setting->type = $requestData['type'] ?? null;
            $setting->save();
            if($setting->notice_type == array_search('NRNA',config('custom.notice_types'))){
                $nrn_notice = new NrnaNotice();
                $nrn_notice->notice_id  = $setting->id;
                $nrn_notice->description  = $requestData['description'] ?? null;
                $nrn_notice->seo_title  = $requestData['seo_title'];
                $nrn_notice->seo_description  = $requestData['seo_description'];
                $nrn_notice->keyword  = $requestData['keyword'];
                $nrn_notice->meta_keyword  = $requestData['meta_keyword'];
                $nrn_notice->image_alt  = $requestData['image_alt'];
                $nrn_notice->image_caption  = $requestData['image_caption'];
                $nrn_notice->image_credit  = $requestData['image_credit'];
                $nrn_notice->save();
            }else{
                $third_party_news = new ThirdPartyNotice();
                $third_party_news->notice_id = $setting->id;
                $third_party_news->url = $requestData['url'];
                $third_party_news->save();
            }

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

        Session::flash('success','Notice successfully created!');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Notice::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting = Notice::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting =Notice::findorfail($id);
        $this->validate(\request(), [
            'title' => 'required|string',
            'notice_type' => 'required|numeric',
            'image' => 'file|mimes:jpeg,png,jpg',
            'status' => 'required|numeric',
            'publish_date' => 'required|date',
            // 'type' => 'required|numeric',
            'description' => 'required_if:notice_type,==,1',
            'url' => 'required_if:notice_type,==,2',
        ]);

        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('notice',config('custom.image_folders')); //for image saved in folder
            $count = rand(1000,9999).date('YYYY-mm-dd');
            $directory = User::makeDirectory($image_folder_type);
            $file_name = $count.'notice.'.$extension;
            \request()->file('image')->move($directory,$file_name);
            $image_path1 = $directory.$file_name;
        }


        $requestData = $request->all();
        // dd($requestData);
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }

        try{
            DB::beginTransaction();
            //update news
            if($setting->notice_type == $requestData['notice_type']){
                $setting->notice_type = $requestData['notice_type'];
                $setting->excerpt = $requestData['excerpt'];
                if(isset($requestData['image'])){
                    $setting->image = $requestData['image'];
                }
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                $setting->type = $requestData['type'];
                $setting->save();
                if($setting->notice_type == array_search('NRNA',config('custom.notice_types'))){
                    $nrn_notice = $setting->nrn_notice;
                    $nrn_notice->description  = $requestData['description'];
                    $nrn_notice->seo_title  = $requestData['seo_title'];
                    $nrn_notice->seo_description  = $requestData['seo_description'];
                    $nrn_notice->keyword  = $requestData['keyword'];
                    $nrn_notice->meta_keyword  = $requestData['meta_keyword'];
                    $nrn_notice->image_alt  = $requestData['image_alt'];
                    $nrn_notice->image_caption  = $requestData['image_caption'];
                    $nrn_notice->image_credit  = $requestData['image_credit'];
                    $nrn_notice->save();
                }else{
                    $third_party_notice = $setting->third_party_notice;
                    $third_party_notice->url = $requestData['url'];
                    $third_party_notice->save();
                }
            }else{
                if($setting->nrn_notice){
                    $setting->nrn_notice->delete();
                }
                if($setting->third_party_notice){
                    $setting->third_party_notice->delete();
                }
                $setting->notice_type = $requestData['notice_type'];
                $setting->excerpt = $requestData['excerpt'];
                if(isset($requestData['image'])){
                    $setting->image = $requestData['image'];

                }
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                // $setting->type = $requestData['type'];
                $setting->save();
                if($setting->notice_type == array_search('NRNA',config('custom.notice_types'))){
                    $nrn_notice = new NrnaNotice();
                    $nrn_notice->news_id  = $setting->id;
                    $nrn_notice->description  = $requestData['description'];
                    $nrn_notice->seo_title  = $requestData['seo_title'];
                    $nrn_notice->seo_description  = $requestData['seo_description'];
                    $nrn_notice->keyword  = $requestData['keyword'];
                    $nrn_notice->image_alt  = $requestData['image_alt'];
                    $nrn_notice->image_caption  = $requestData['image_caption'];
                    $nrn_notice->image_credit  = $requestData['image_credit'];
                    $nrn_notice->save();
                }else{
                    $third_party_news = new ThirdPartyNotice();
                    $third_party_news->notice_id = $setting->id;
                    $third_party_news->url = $requestData['url'];
                    $third_party_news->save();
                }
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        Session::flash('success','Notice successfully updated!');
        return redirect($this->redirect);

    }

            public function delete($id){
                $setting=Notice::findorfail($id);
                if($setting->third_party_notice){
                    $setting->third_party_notice()->delete();
                }
                if($setting->nrn_notice){
                    $setting->nrn_notice()->delete();
                }

                if($setting->delete()){
                    if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                        unlink(public_path().'/'.$setting->image);
                    }
                }
                Session::flash('success','Notice is deleted !');
                return redirect($this->redirect);
            }

            public function getNoticeDom($notice_type)
            {
                if('NRNA' == config('custom.notice_types')[$notice_type]){
                    $returnHTML = view($this->view.'nrna_notice')->render();// or method that you prefere to return data + RENDER is the key here
                }else{
                    $returnHTML = view($this->view.'third_party_notice')->render();// or method that you prefere to return data + RENDER is the key here
                }
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
            public function getNoticeDomEdit($notice_type,$notice_id)
            {
                $setting = Notice::findOrFail($notice_id);
                if($setting->notice_type == $notice_type){
                    if('NRNA' == config('custom.notice_types')[$notice_type]){
                        $returnHTML = view($this->view.'nrna_notice',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
                    }else{
                        $returnHTML = view($this->view.'third_party_notice',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
                    }
                }else{
                    if('NRNA' == config('custom.notice_types')[$notice_type]){
                        $returnHTML = view($this->view.'nrna_notice')->render();// or method that you prefere to return data + RENDER is the key here
                    }else{
                        $returnHTML = view($this->view.'third_party_notice')->render();// or method that you prefere to return data + RENDER is the key here
                    }
                }

                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
}
