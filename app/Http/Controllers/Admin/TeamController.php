<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Period;
use App\Models\Team;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    protected $view = 'admin.team.';
    protected $redirect = 'admin/team';

    public function index()
    {
        $teams = Team::where('status', 1);

        if (\request('full_name')) {
            $key = \request('full_name');
            $teams = $teams->where('full_name', 'like', '%'.$key.'%');
        }
        if (\request('status')) {
            $key = \request('status');
            $teams = $teams->where('status', $key);
        }
        $teams = $teams->paginate(config('custom.per_page'));
        return view($this->view.'index', compact('teams'));
    }

    public function create()
    {
        $designations = Designation::where('status',1)->get();
        $teamPeriods = Period::where('status',1)->get();
        
        return view($this->view . 'create', compact('designations', 'teamPeriods'));
    }

    public function store(Request $request)
    {       
        $this->validate(\request(), [
                'team_type' => 'required',
                'status' => 'required',
                'designation' => 'required',
                'period' => 'required',
                'full_name' => 'required',
                'state' => 'required',
                'image' => 'file|mimes:jpeg,png,jpg',
        ]);

        $requestData = $request->all();

        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('team',config('custom.image_folders')); //for image saved in folder
            $count = rand(1000,9999).date('YYYY-mm-dd');
            $directory = User::makeDirectory($image_folder_type);
            $file_name = $count.'team.'.$extension;
            \request()->file('image')->move($directory,$file_name);
            $image_path1 = $directory.$file_name;
        }

        if (isset($image_path1)) {
            $requestData['image'] = $image_path1;
        }
        $requestData['designation_id'] = $request->designation;
        $requestData['period_id'] = $request->period;
        $requestData['state_id'] = $request->state;
        $team = Team::create($requestData);
        if ($team) {
            Session::flash('success', 'Team successfully created');
        }else {
            Session::flash('error', 'Something went wrong.Please try again');
        }
        return redirect($this->redirect);
        
    }

    public function show($id)
    {
        $team =Team::findorfail($id);
        return view($this->view.'show',compact('team'));
    }

    public function edit($id){
        $team =Team::findorfail($id);
        $designations = Designation::where('status',1)->get();
        $teamPeriods = Period::where('status',1)->get();
        return view($this->view.'edit',compact('team','designations','teamPeriods'));
    }

    public function update(Request $request, $id){

        $setting =Team::findorfail($id);
        
        $this->validate(\request(), [
            'team_type' => 'required',
                'status' => 'required',
                'designation' => 'required',
                'period' => 'required',
                'full_name' => 'required',
                'state' => 'required',
                'image' => 'file|mimes:jpeg,png,jpg',
        ]);

        $requestData = $request->all();
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('team', config('custom.image_folders')); //for image saved in folder
            $count = rand(100, 999);
            $out_put_path = User::save_image($request->file('image'),$extension,$count,$image_folder_type);
            $image_path1 = $out_put_path[0];

            $requestData['image'] = $image_path1;

            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }
            
        }
        $requestData['designation_id'] = $request['designation'];
        $requestData['period_id'] = $request['period'];
        $requestData['state_id'] = $request['state'];
        $setting->fill($requestData);
        $setting->save();
        
        Session::flash('success','Team successfully update.');
        return redirect($this->redirect);

    }

    public function delete($id){
        $setting=Team::findorfail($id);
        
        if($setting->delete()){
            if (is_file(public_path().'/'.$setting->image) && file_exists(public_path().'/'.$setting->image)){
                unlink(public_path().'/'.$setting->image);
            }
            Session::flash('success','Team successfully deleted !');
            return redirect($this->redirect);
        }
        
    }
}

