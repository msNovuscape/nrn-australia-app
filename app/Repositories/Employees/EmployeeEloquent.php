<?php

namespace App\Repositories\Employees;


use App\Models\EmployeeImage;
use App\Models\Employees;
use App\Models\Process;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\EmployeeResignDate;

class EmployeeEloquent implements EmployeeRepository
{
    private $model;
    private $employeeResignDate;

    public function __construct(Employees $model, EmployeeResignDate $employeeResignDate)
    {
        $this->model = $model;
        $this->employeeResignDate = $employeeResignDate;
    }

    public function all(array $attributes)
    {
        return $this->model->with('profileImage', 'resignDate')
            ->when(isset($attributes['type']), function ($q) use ($attributes) {
                if ($attributes['type'] == 'active') {
                    $q->where('is_active', 1);
                }
                if ($attributes['type'] == 'inactive') {
                    $q->where('is_active', 0);
                }
            })
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('first_name', 'like', '%' . $attributes['search'] . '%')->orWhere('middle_name', 'like', '%' . $attributes['search'] . '%')->orWhere('last_name', 'like', '%' . $attributes['search'] . '%');
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function find($id)
    {
        return $this->model->with('profileImage', 'resignDate')->findorfail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        if (!isset($attributes['first_name']) && !isset($attributes['last_name']) && !isset($attributes['date_of_join'])) {
            return false;
        }
        $attributes['first_name'] = ucfirst($attributes['first_name']);
        $attributes['last_name'] = ucfirst($attributes['last_name']);
        $attributes['middle_name'] = isset($attributes['middle_name']) ? ucfirst($attributes['middle_name']) : '';
        $employeeId = isset($attributes['id']) ? $attributes['id'] : 0;
        $data = $this->model->updateOrCreate([
            'id' => $employeeId,
        ], $attributes);

        if ($employeeId == 0 && isset($attributes['date_of_join']) && isset($attributes['first_name']) && isset($attributes['last_name'])) {
            $year = Carbon::parse($attributes['date_of_join'])->format('y');
            $month = Carbon::parse($attributes['date_of_join'])->format('m');
            $date = Carbon::parse($attributes['date_of_join'])->format('d');
            $first = strtoupper($attributes['first_name'][0]);
            $last = strtoupper($attributes['last_name'][0]);
            $data->employee_code = $month . $year . $date . str_pad($data->id, 4, '0', STR_PAD_LEFT) . $first . $last;
            $data->save();
            return true;
        }
        if($employeeId > 0 && $attributes['resign_date'] && $attributes['is_active'] == 1) {
            $data->is_active = 0;
            $data->save();
            $this->employeeResignDate->create(['employee_id' => $data->id, 'resign_date' => $attributes['resign_date']]);
        }
        return $data;
    }

    public function update($attributes, $id)
    {
//        $model =$this->model->findorfail($id);
//        $model->update($attributes);
//        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    private function random_alphanumeric_string($length, $repeats)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($chars, $repeats)), 0, $length);
    }

    public function saveProfileImage(array $attributes)
    {
        if(isset($attributes['profile_image'])){
            $employeeImage = (new EmployeeImage())->where('employee_id', $attributes['employee_id'])->where('name', 'profile_image')->first();
            if(!empty($employeeImage)){
                $employeeImage->delete();
                $path = public_path().parse_url($employeeImage->path)['path'];
                unlink($path);
            }
            $attributes['name'] = 'profile_image';
            $attributes['path'] = $this->model->saveImage($attributes['profile_image']);
            return (new EmployeeImage())->create($attributes);
        }
        if(isset($attributes['pan_image'])){
            $employeeImage = (new EmployeeImage())->where('employee_id', $attributes['employee_id'])->where('name', 'pan_image')->first();
            if(!empty($employeeImage)){
                $employeeImage->delete();
                $path = public_path().parse_url($employeeImage->path)['path'];
                unlink($path);
            }
            $attributes['name'] = 'pan_image';
            $attributes['path'] = $this->model->saveImage($attributes['pan_image']);
            return (new EmployeeImage())->create($attributes);
        }
        if(isset($attributes['citizenship_image'])){
            $employeeImage = (new EmployeeImage())->where('employee_id', $attributes['employee_id'])->where('name', 'citizenship_image')->first();
            if(!empty($employeeImage)){
                $employeeImage->delete();
                $path = public_path().parse_url($employeeImage->path)['path'];
                unlink($path);
            }
            $attributes['name'] = 'citizenship_image';
            $attributes['path'] = $this->model->saveImage($attributes['citizenship_image']);
            return (new EmployeeImage())->create($attributes);
        }
        if(isset($attributes['license_image'])){
            $employeeImage = (new EmployeeImage())->where('employee_id', $attributes['employee_id'])->where('name', 'license_image')->first();
            if(!empty($employeeImage)){
                $employeeImage->delete();
                $path = public_path().parse_url($employeeImage->path)['path'];
                unlink($path);
            }
            $attributes['name'] = 'license_image';
            $attributes['path'] = $this->model->saveImage($attributes['license_image']);
            return (new EmployeeImage())->create($attributes);
        }
        return false;
    }

    public function toggleEmployee($id)
    {
        $employee = $this->model->find($id);
        $employee->is_active = !$employee->is_active;
        $employee->resign_date = null;
        return $employee->save();
    }
}

