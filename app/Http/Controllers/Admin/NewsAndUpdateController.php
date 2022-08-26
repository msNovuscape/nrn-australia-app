<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\NewsPoint;
use App\Models\BlogPoint;
use App\Models\News;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {       
        
   
            $this->validate(\request(), [
                'description' => 'required',
                // 'bottom_description' => 'required',
                'seo_title' => 'nullable',
                'seo_description' => 'nullable',
                'publish_date' =>'required',
                'keyword' => 'required',
                'meta-keyword' => 'nullable',
                'status' => 'required',
                'image' => 'required|file|mimes:jpeg,png,jpg,pdf'
            ]);
            if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('blog',config('custom.image_folders')); //for image saved in folder
                $count = rand(100,999);
                $out_put_path = User::save_image(\request('image'),$extension,$count,$image_folder_type);
                $image_path1 = $out_put_path[0];
            }

        $requestData = $request->all();
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }

        $requestData['slug'] = Setting::create_slug($requestData['keyword']);
        $setting = News::create($requestData);
        if(\request('point_title')){
            foreach (\request('point') as $index => $value){
                $setting_point = new NewsPoint();
                $setting_point->news_id = $setting->id;
                $setting_point->point = $value;
                $setting_point->save();
            }
        }
        Session::flash('success','Blog successfully created');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =News::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting =News::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

//        dd(\request()->all());
        $setting =News::findorfail($id);
        $this->validate(\request(), [
            'description' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'keyword' => 'required',
            'meta-keyword' => 'nullable',
            'status' => 'required',
            'publish_date'=>'required',
        ]);

        if(\request('image')){
            $this->validate(\request(),[
                'image' => 'file|mimes:jpeg,png,jpg,pdf'
            ]);
            if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('blog',config('custom.image_folders')); //for image saved in folder
                $count = rand(100,999);
                $out_put_path = User::save_image(\request('image'),$extension,$count,$image_folder_type);
                $image_path1 = $out_put_path[0];
                if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                    unlink(public_path().'/'.$setting->image);
                }
            }
        }


        $requestData = $request->all();
        $requestData['slug'] = Setting::create_slug($requestData['keyword']);
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }
        $setting->fill($requestData);
        $setting->save();
        if(\request('point_title') ){
            if(\request('point')){
                foreach (\request('point') as $index => $value){
                    $setting_point = new NewsPoint();
                    $setting_point->news_and_update_id = $setting->id;
                    $setting_point->point = $value;
                    $setting_point->save();
                }
            }
            if(\request('point_old_id')){
                foreach (\request('point_old_id') as $in => $value1){
                    $setting_point_update = NewsPoint::findOrFail($value1);
                    $setting_point_update->news_and_update_id = $setting->id;
                    $setting_point_update->point = \request('point_old')[$in];
                    $setting_point_update->save();
                }
            }

        }
        Session::flash('success','Blog succesffuly edited.');
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

    public function blog_point($blog_point_id)
    {
        if(Auth::user()){
            $setting = BlogPoint::findorfail($blog_point_id);
            $setting->delete();
            return response()->json(['blog_point_id' => $blog_point_id]);
        }

    }

}
