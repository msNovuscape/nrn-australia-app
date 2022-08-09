<?php

namespace App\Repositories\ShadeCard;

use App\Models\Shade;

class ShadeCardEloquent implements ShadeCardRepository
{
    protected $model;

    public function __construct(Shade $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with(['manufacture'])->orderBy('updated_at', 'desc')->get();
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
        $unitId = isset($attributes['id']) ? $attributes['id']: 0;
        return $this->model->updateOrCreate(['id' => $unitId], $attributes);
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
