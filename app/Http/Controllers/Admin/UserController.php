<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Mail;
class UserController extends Controller
{
    protected $view = 'admin.user.';
    protected $redirect = 'admin/users';

    public function index(){
        $users = User::where(['is_admin' => true,'is_super_admin' => false])->orderBy('id','DESC')->get();
        if(\request('full_name')){
            $key = \request('full_name');
            $settings = $users->where('full_name','like','%'.$key.'%');
        }
        // if(\request('status')){
        //     $key = \request('status');
        //     $settings = $users->where('status',$key);
        // }
        return view($this->view.'index',compact('users'));
    }

    public function create(){
        $roles = Role::select('id','name')->get();
        return view($this->view . 'create',compact('roles'));

    }

    public function store(Request $request){
        $this->validate(\request(), [
            'full_name' => 'required',
            'status' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $request['is_admin'] = true;
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        if($user){

            $email_data = array(
                'name' => $user['full_name'],
                'email' => $user['email'],
                'url'  => url('admin/change_password')
            );
        $role = Role::find($request->role)->name;
        $user->assignRole($role);
        Mail::send('admin.welcome_email', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
            ->subject('Welcome to NRNA Admin Panel');
            // ->from('info@mynotepaper.com', 'MyNotePaper');
    });

        Session::flash('success','User successfully created');
        return redirect($this->redirect);
        }
    }

    public function edit($id){
        $user = User::findorfail($id);
        $roles = Role::select('id','name')->get();
        return view($this->view.'edit', compact('user', 'roles'));
    }

    public function update(Request $request,$id){

        $this->validate(\request(), [
                'full_name' => 'required',
                'status' => 'required',
                'email' => 'required',
                'role' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['is_admin'] = true;
        $user = User::findorfail($id);
        $user->fill($requestData);
        $user->save();

        $role = Role::find($request->role)->name;
        $user->syncRoles($role);

        Session::flash('success','User successfully updated.');
        return redirect($this->redirect);
        


    }

    public function delete($id){
        $user = User::findorfail($id);
        if($user->delete()){
            Session::flash('success','User is successfully deleted !');
            return redirect($this->redirect);
        }
    }
}
