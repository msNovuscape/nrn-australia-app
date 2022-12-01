<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Models\SettingImageAlt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    protected $view = 'admin.setting.';
    protected $redirect = 'admin/settings';

    public function index()
    {
        $settings = Setting::orderBy('id','asc');


        if(\request('name')){
            $key = \request('name');
            $settings = $settings->where('key','like','%'.$key.'%');
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
        return view($this->view.'create');
    }

    public function store(Request $request)
    {

        $this->validate(\request(),[
            'type' => 'required',
            'key' => 'required',
            'value' => 'required',
            'status' => 'required'
        ]);

        $setting = new Setting();

        $setting->key = \request('key');
        $setting->type = \request('type');
        $setting->status = \request('status');
        $setting->slug = Setting::create_slug(\request('key'));
        if(request('type') == array_search('Image',config('custom.setting_types'))){
            $this->validate($request,[
                    'value'=>'required|file|mimes:jpeg,png,jpg,pdf'
                ]
            );

            if($request->hasFile('value')){
                $extension = \request()->file('value')->getClientOriginalExtension();
                $image_folder_type = array_search('setting',config('custom.image_folders')); //for image saved in folder
                $count = rand(100,999);
                $out_put_path = User::save_image(\request('value'),$extension,$count,$image_folder_type);
                $image_path = $out_put_path[0];
                $setting->value = $image_path;
            }

        }else{
            $setting->value = \request('value');
        }
        $setting->save();
        if(\request('image_alt')){
            $image_alt = new SettingImageAlt();
            $image_alt->setting_id = $setting->id;
            $image_alt->image_alt = \request('image_alt');
            $image_alt->save();
        }
        Session::flash('success','Setting has been created!');
        return redirect($this->redirect);
    }

    public function getAll()
    {
        $settings = Setting::all();
        return SettingResource::collection(Setting::all());
    }

    public function getSetting()
    {
        $slug = \request('slug');
        $setting = Setting::where('slug',$slug)->where('status',1)->first();
        return new SettingResource($setting);
    }

    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
//        dd(array_search('Image',config('custom.setting_types')));
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(\request(),[
            'type' => 'required',
            'key' => 'required',
            'status' => 'required'
        ]);
        $setting = Setting::findOrFail($id);
        $setting->key = \request('key');
        $setting->type = \request('type');
        $setting->status = \request('status');
        $setting->slug = Setting::create_slug(\request('key'));
        if(request('type') == array_search('Image',config('custom.setting_types'))){
            if(\request('value')){
                $this->validate($request,[
                        'value'=>'required|file|mimes:jpeg,png,jpg,pdf'
                    ]
                );

                if($request->hasFile('value')){
                    if (is_file(public_path().'/'.$setting->value) && file_exists(public_path().'/'.$setting->value)){
                        unlink(public_path().'/'.$setting->value);
                    }
                    $extension = \request()->file('value')->getClientOriginalExtension();
                    $image_folder_type = array_search('setting',config('custom.image_folders')); //for image saved in folder
                    $count = rand(100,999);
                    $out_put_path = User::save_image(\request('value'),$extension,$count,$image_folder_type);
                    $image_path = $out_put_path[0];
                    $setting->value = $image_path;
                }
                
            }


        }else{
            $this->validate($request,[
                    'value'=>'required'
                ]
            );
            $setting->value = \request('value');
        }
        $setting->save();
        if(\request('image_alt')){
            if($setting->setting_image_alt){
                $image_alt = $setting->setting_image_alt;
                $image_alt->setting_id = $setting->id;
                $image_alt->image_alt = \request('image_alt');
                $image_alt->save();
            }else{
                $image_alt = new SettingImageAlt();
                $image_alt->setting_id = $setting->id;
                $image_alt->image_alt = \request('image_alt');
                $image_alt->save();
            }
        }else{
            if($setting->setting_alt){
                $setting->setting_alt->delete();
            }
        }
        Session::flash('success','Setting has been created!');
        return redirect($this->redirect);
    }

    public function delete($id)
    {
        $setting=Setting::findorfail($id);
        if (is_file(public_path().'/'.$setting->value) && file_exists(public_path().'/'.$setting->value)){
            unlink(public_path().'/'.$setting->value);
        }
        $setting->delete();
        Session::flash('success','Setting has been sucessfully deleted!');
        return redirect($this->redirect);
        //dd("here");
    }
}
