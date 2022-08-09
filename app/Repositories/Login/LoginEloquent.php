<?php

namespace App\Repositories\Login;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginEloquent implements LoginRepository
{
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all($id)
    {
        return $this->model
            ->with(['employee', 'project', 'projectDetail', 'process', 'stock', 'equipment'])
            ->where('project_work_detail_id', $id)
            ->orderBy('created_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model
            ->with(['employee', 'project', 'projectDetail', 'process', 'stock', 'equipment'])
            ->findOrFail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function login($attributes)
    {
        $user = Auth::attempt(['email' => $attributes['email'], 'password' => $attributes['password']]);
        
        if ($user) {
            return $user;
        }else{
            return false;
        }
    }

    public function update($attributes, $id)
    {
        $model = $this->model->find($id);
        $model->update($attributes);
        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function getTodayAttendance(array $attributes)
    {
        return $this->model->with(['project','employee'])
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->whereNull('job_end')
            ->get();
    }

    public function getTodayAbsentAttendance(array $attributes)
    {
        $presentEmployees =  $this->model->where('date', Carbon::now()->format('Y-m-d'))
            ->whereNull('job_end')
            ->pluck('employee_id')->toArray();
        dd($presentEmployees);
        return (new Employees())->where('is_active', 1)->whereNotIn('id', $presentEmployees)->get();

    }

    public function storeFirstPhaseAttendance(array $attributes)
    {
        foreach ($attributes as $attribute) {
            if(isset($attribute['date']) && isset($attribute['employee_id']) && isset($attribute['job_start']) &&
                isset($attribute['project_id'])
            ) {
                $this->model->create($attribute);
            }
        }
        return true;
    }

    public function addPhaseAttendanceJobEnd(array $attributes)
    {
        $attendance = $this->model->find($attributes['id']);
        $attendance->job_end = $attributes['job_end'];
        return $attendance->save();
    }

    public function editFirstPhaseAttendance(array $attributes)
    {
        $attendance = $this->model->find($attributes['id']);
        $attendance->date = $attributes['date'];
        $attendance->employee_id  = $attributes['employee_id'];
        $attendance->job_start = $attributes['job_start'];
        $attendance->project_id = $attributes['project_id'];
        return $attendance->save();
    }
}
