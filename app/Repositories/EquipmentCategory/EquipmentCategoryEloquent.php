<?php

namespace App\Repositories\EquipmentCategory;

use App\Models\EquipmentCategory;

class EquipmentCategoryEloquent implements EquipmentCategoryRepository
{

    public $model;

    public function __construct(EquipmentCategory $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBy($filled, $value)
    {
        $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $categoryId = isset($attributes['id']) ? $attributes['id']: 0;
        return $this->model->updateOrCreate(['id' => $categoryId], $attributes);
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
