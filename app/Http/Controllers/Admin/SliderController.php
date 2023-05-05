<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    protected $view = 'admin.slider.';
    protected $redirect = 'admin/sliders';

    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('order', 'asc');

        // if (\request('full_name')) {
        //     $key = \request('full_name');
        //     $teams = $teams->where('full_name', 'like', '%'.$key.'%');
        // }
        // if (\request('status')) {
        //     $key = \request('status');
        //     $teams = $teams->where('status', $key);
        // }
        $sliders = $sliders->paginate(config('custom.per_page'));
        return view($this->view.'index', compact('sliders'));
    }

    public function create()
    {

        return view($this->view . 'create');
    }

    public function store(Request $request)
    {
        $this->validate(\request(), [
                'order' => 'required|unique:sliders',
                'status' => 'required',
                'image' => 'file|mimes:jpeg,png,jpg',
        ]);

        $requestData = $request->all();

        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('slider',config('custom.image_folders')); //for image saved in folder
            $count = rand(1000,9999).date('YYYY-mm-dd');
            $directory = User::makeDirectory($image_folder_type);
            $file_name = $count.'slider.'.$extension;
            \request()->file('image')->move($directory,$file_name);
            $image_path1 = $directory.$file_name;
        }

        if (isset($image_path1)) {
            $requestData['image'] = $image_path1;
        }

        $slider = Slider::create($requestData);
        if ($slider) {
            Session::flash('success', 'Slider successfully created');
        }else {
            Session::flash('error', 'Something went wrong.Please try again');
        }
        return redirect($this->redirect);

    }

    public function show($id)
    {
        $slider =Slider::findorfail($id);
        return view($this->view.'show', compact('slider'));
    }

    public function edit($id){
        $slider = Slider::findorfail($id);
        return view($this->view.'edit', compact('slider'));
    }

    public function update(Request $request, $id){

        $setting =Slider::findorfail($id);

        $this->validate(\request(), [
            'order' => [
                'required',
                Rule::unique('sliders')->ignore($setting->id)
            ],
                'status' => 'required',
                'image' => 'file|mimes:jpeg,png,jpg',
        ]);

        $requestData = $request->all();
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('slider', config('custom.image_folders')); //for image saved in folder
            $count = rand(100, 999);
            $out_put_path = User::save_image($request->file('image'),$extension,$count,$image_folder_type);
            $image_path1 = $out_put_path[0];

            $requestData['image'] = $image_path1;

            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }

        }
        $setting->fill($requestData);
        $setting->save();

        Session::flash('success','Slider successfully update.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=Slider::findorfail($id);

        if($setting->delete()){
            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }
            Session::flash('success','Slider successfully deleted !');
            return redirect($this->redirect);
        }

    }
}

