<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    protected $view = 'admin.gallery.';
    protected $redirect = 'admin/gallery';

    public function index()
    {
        $settings = Gallery::where('status',1)->orderBy('id','DESC');

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
                'images.*' => 'required|file|mimes:jpeg,png,jpg',
                'status' => 'required|numeric',
                'date' => 'required|date',
            ]);

            
        $requestData = $request->all();
        if(isset($image_path1)){
            $requestData['image'] = $image_path1;
        }

        // $requestData['slug'] = Setting::create_slug($requestData['title']);

        try{
            DB::beginTransaction();
            //create news
            $setting = new Gallery();
            $setting->status = $requestData['status'];
            $setting->date = $requestData['date'];
            $setting->title = $requestData['title'];
            $setting->save();
            
            if($request->hasFile('images')){
                foreach($request->file('images') as $imagefile) {
                $extension = $imagefile->getClientOriginalExtension();
                $image_folder_type = array_search('gallery',config('custom.image_folders')); //for image saved in folder
                $count = rand(100,999);
                $out_put_path = User::save_image($imagefile,$extension,$count,$image_folder_type);
                $image_path1 = $out_put_path[0];
                $gallery_image = new GalleryImage();
                $gallery_image->gallery_id = $setting->id;
                $gallery_image->image = $image_path1;
                $gallery_image->save();
                
                }
                
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }



        Session::flash('success','Gallery successfully created!');
        return redirect($this->redirect);
    }

    public function show($id)
    {
        $setting =Gallery::findorfail($id);
        return view($this->view.'show',compact('setting'));
    }

    public function edit($id){
        $setting = Gallery::findorfail($id);
        return view($this->view.'edit',compact('setting'));
    }

    public function update(Request $request, $id){

        //        dd(\request()->all());
                $setting =Gallery::findorfail($id);
                    $this->validate(\request(), [
                        'title' => 'required',
                        'date' => 'required',
                        'status' => 'required'
                        // 'images' => 'required',
                        // 'slider_image' => 'required|file|mimes:jpeg,png,jpg'
                    ]);
        
        
                $requestData = $request->all();
                // $requestData['slug'] = Setting::create_slug($requestData['keyword']);
                
                $setting->fill($requestData);
                if($setting->save()){
                    
                    if($request->hasFile('images')){
                        
                        foreach($setting->gallery_images as $gallery){
                            if (is_file(url($gallery->image)) && file_exists(url($gallery->image))){
                                unlink(url($gallery->image));
                            }
                        }
                        $gallery_image = $setting->gallery_images();
                        $gallery_image->delete();
                        foreach($request->file('images') as $imagefile) {
                            $extension = $imagefile->getClientOriginalExtension();
                            $image_folder_type = array_search('gallery',config('custom.image_folders')); //for image saved in folder
                            $count = rand(100,999);
                            $out_put_path = User::save_image($imagefile,$extension,$count,$image_folder_type);
                            $image_path1 = $out_put_path[0];
                            
                            
                            $gallery_image = new GalleryImage();
                            $gallery_image->gallery_id = $id;
                            $gallery_image->image = $image_path1;
                            $gallery_image->save();
                        
                        }
                        
                    }
                   
 
                        
                }
        
                Session::flash('success','Gallery succesffuly edited.');
                return redirect($this->redirect);
        
            }

            public function delete($id){
                $setting=Gallery::findorfail($id);
                if($setting->gallery_images->count() > 0){
                    $setting->gallery_images()->delete();
                }
                if($setting->delete()){
                    if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                        unlink(public_path().'/'.$setting->image);
                    }
                }
                Session::flash('success','Gallery is deleted !');
                return redirect($this->redirect);
            }
}
