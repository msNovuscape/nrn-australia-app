<?php

namespace App\Repositories\ProductTypes;


use App\Models\ProductTypes;

class ProductTypeEloquent implements ProductTypeRepository
{
    private $model;

    public function __construct(ProductTypes $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model
            ->when(isset($attributes['type']), function ($q) use ($attributes) {
            if ($attributes['type'] == 'active') {
                $q->where('is_active', 1);
            }
            if ($attributes['type'] == 'inactive') {
                $q->where('is_active', 0);
            }
        })
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('name', 'like', '%' . $attributes['search'] . '%');
            })

            ->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function find($id)
    {
        return $this->model->findorfail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $categoryId = isset($attributes['id']) ? $attributes['id'] : 0;
        $this->model->updateOrCreate([
            'id' => $categoryId
        ],$attributes);
    }

    public function update($attributes, $id)
    {
        $model =$this->model->findorfail($id);
        $model->update($attributes);
        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}

