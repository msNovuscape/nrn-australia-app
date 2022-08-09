<?php

namespace App\Repositories\Manufacture;

use App\Models\Manufacture;

class ManufactureEloquent implements ManufactureRepository
{
    protected $model;

    public function __construct(Manufacture $manufacture)
    {
        $this->model = $manufacture;
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
        $manufactureId = isset($attributes['id']) ? $attributes['id']: 0;
        return $this->model->updateOrCreate(['id' => $manufactureId], $attributes);
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
