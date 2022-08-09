<?php

namespace App\Repositories\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use Carbon\Carbon;

class EquipmentEloquent implements EquipmentRepository
{

    public $model;

    public function __construct(Equipment $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with('category', 'manufacture')->orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->with('category', 'manufacture')->findOrFail($id);
    }

    public function findBy($filled, $value)
    {
        $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $equipmentId = isset($attributes['id']) ? $attributes['id']: 0;
        $attributes['operating_cost'] = ceil(($attributes['purchase_amount'] / $attributes['expected_life']) / 10) * 10;
        $data =  $this->model->updateOrCreate(['id' => $equipmentId], $attributes);
        if($equipmentId == 0 ) {
            $category = (new EquipmentCategory())->find($attributes['category_id']);
            $categoryFirstLetter = strtoupper($category->code[0]);
            $year = Carbon::parse($attributes['date_of_used'])->format('y');
            $month = Carbon::parse($attributes['date_of_used'])->format('m');
            $modelNo = substr($attributes['model_no'], 0, 2);
            $data->code = $categoryFirstLetter. str_pad($data->id, 3, '0', STR_PAD_LEFT) . $year.$month.$modelNo;
            $data->save();
        }
        return $data;
    }

    public function update($attributes, $id)
    {
        $model = $this->find($id);
        $model->update($attributes);
        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}
