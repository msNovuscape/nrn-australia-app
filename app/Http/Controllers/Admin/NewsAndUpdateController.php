<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\NewsPoint;
use App\Models\BlogPoint;
use App\Models\News;
use App\Models\NrnaNews;
use App\Models\Setting;
use App\Models\ThirdPartyNews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Promise\all;

class NewsAndUpdateController extends Controller
{
    protected $view = 'admin.news_and_update.';
    protected $redirect = 'admin/news';

    public function index()
    {
        $settings = News::orderBy('id','DESC');

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
        return view($this->view . 'create');
    }

    public function getNewsDom($news_type)
    {
        if('NRNA' == config('custom.news_types')[$news_type]){
            $returnHTML = view($this->view.'nrna_news')->render();// or method that you prefere to return data + RENDER is the key here
        }else{
            $returnHTML = view($this->view.'third_party_news')->render();// or method that you prefere to return data + RENDER is the key here
        }
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
    public function getNewsDomEdit($news_type,$news_id)
    {
        $setting = News::findOrFail($news_id);
        if($setting->news_type == $news_type){
            if('NRNA' == config('custom.news_types')[$news_type]){
                $returnHTML = view($this->view.'nrna_news',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
            }else{
                $returnHTML = view($this->view.'third_party_news',['setting' => $setting])->render();// or method that you prefere to return data + RENDER is the key here
            }
        }else{
            if('NRNA' == config('custom.news_types')[$news_type]){
                $returnHTML = view($this->view.'nrna_news')->render();// or method that you prefere to return data + RENDER is the key here
            }else{
                $returnHTML = view($this->view.'third_party_news')->render();// or method that you prefere to return data + RENDER is the key here
            }
        }

        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function store(Request $request)
    {

            $this->validate(\request(), [
                'title' => 'required|string',
                'excerpt' => 'required|string',
                'news_type' => 'required|numeric',
                'image' => 'required|file|mimes:jpeg,png,jpg',
                'status' => 'required|numeric',
                'publish_date' => 'required|date',
                'type' => 'required|numeric',
                'description' => 'required_if:news_type,==,1',
                'url' => 'required_if:news_type,==,2',
            ]);

        if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('news',config('custom.image_folders')); //for image saved in folder
                $count = rand(1000,9999).date('YYYY-mm-dd');
                $directory = User::makeDirectory($image_folder_type);
                $file_name = $count.'news.'.$extension;
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
            $setting = new News();
            $setting->news_type = $requestData['news_type'];
            $setting->excerpt = $requestData['excerpt'];
            $setting->image = $requestData['image'];
            $setting->slug = $requestData['slug'];
            $setting->status = $requestData['status'];
            $setting->publish_date = $requestData['publish_date'];
            $setting->title = $requestData['title'];
            $setting->type = $requestData['type'];
            $setting->save();
            if($setting->news_type == array_search('NRNA',config('custom.news_types'))){
                $nrna_news = new NrnaNews();
                $nrna_news->news_id  = $setting->id;
                $nrna_news->description  = $requestData['description'];
                $nrna_news->seo_title  = $requestData['seo_title'];
                $nrna_news->seo_description  = $requestData['seo_description'];
                $nrna_news->keyword  = $requestData['keyword'];
                $nrna_news->meta_keyword  = $requestData['meta_keyword'];
                $nrna_news->image_alt  = $requestData['image_alt'];
                $nrna_news->image_caption  = $requestData['image_caption'];
                $nrna_news->image_credit  = $requestData['image_credit'];
                $nrna_news->save();
            }else{
                $third_party_news = new ThirdPartyNews();
                $third_party_news->news_id = $setting->id;
                $third_party_news->url = $requestData['url'];
                $third_party_news->save();
            }

            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }



        Session::flash('success','News successfully created!');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =News::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting = News::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting =News::findorfail($id);
        $this->validate(\request(), [
            'title' => 'required|string',
            'news_type' => 'required|numeric',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg',
            'status' => 'required|numeric',
            'publish_date' => 'required|date',
            'type' => 'required|numeric',
            'description' => 'required_if:news_type,==,1',
            'url' => 'required_if:news_type,==,2',
        ]);

        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('news',config('custom.image_folders')); //for image saved in folder
            $count = rand(1000,9999).date('YYYY-mm-dd');
            $directory = User::makeDirectory($image_folder_type);
            $file_name = $count.'news.'.$extension;
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
            if($setting->news_type == $requestData['news_type']){
                $setting->news_type = $requestData['news_type'];
                $setting->excerpt = $requestData['excerpt'];
                if(isset($requestData['image'])){
                    $setting->image = $requestData['image'];
                }
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                $setting->type = $requestData['type'];
                $setting->save();
                if($setting->news_type == array_search('NRNA',config('custom.news_types'))){
                    $nrna_news = $setting->nrn_news;
                    $nrna_news->description  = $requestData['description'];
                    $nrna_news->seo_title  = $requestData['seo_title'];
                    $nrna_news->seo_description  = $requestData['seo_description'];
                    $nrna_news->keyword  = $requestData['keyword'];
                    $nrna_news->meta_keyword  = $requestData['meta_keyword'];
                    $nrna_news->image_alt  = $requestData['image_alt'];
                    $nrna_news->image_caption  = $requestData['image_caption'];
                    $nrna_news->image_credit  = $requestData['image_credit'];
                    $nrna_news->save();
                }else{
                    $third_party_news = $setting->third_party_news;
                    $third_party_news->url = $requestData['url'];
                    $third_party_news->save();
                }
            }else{
                if($setting->nrn_news){
                    $setting->nrn_news->delete();
                }
                if($setting->third_party_news){
                    $setting->third_party_news->delete();
                }
                $setting->news_type = $requestData['news_type'];
                $setting->excerpt = $requestData['excerpt'];
                $setting->image = $requestData['image'];
                $setting->status = $requestData['status'];
                $setting->publish_date = $requestData['publish_date'];
                $setting->title = $requestData['title'];
                $setting->type = $requestData['type'];
                $setting->save();
                if($setting->news_type == array_search('NRNA',config('custom.news_types'))){
                    $nrna_news = new NrnaNews();
                    $nrna_news->news_id  = $setting->id;
                    $nrna_news->description  = $requestData['description'];
                    $nrna_news->seo_title  = $requestData['seo_title'];
                    $nrna_news->seo_description  = $requestData['seo_description'];
                    $nrna_news->keyword  = $requestData['keyword'];
                    $nrna_news->image_alt  = $requestData['image_alt'];
                    $nrna_news->image_caption  = $requestData['image_caption'];
                    $nrna_news->image_credit  = $requestData['image_credit'];
                    $nrna_news->save();
                }else{
                    $third_party_news = new ThirdPartyNews();
                    $third_party_news->news_id = $setting->id;
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
        Session::flash('success','News successfully updated!');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=News::findorfail($id);
        if($setting->news_and_update_points->count() > 0){
            $setting->news_and_update_points()->delete();
        }
        if($setting->delete()){
            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }
        }
        Session::flash('success','Blog is deleted !');
        return redirect($this->redirect);
    }

}
