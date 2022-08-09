<?php

namespace App\Repositories\Stock;

use App\Models\Stocks;

class StockEloquent implements StockRepository
{

    public $model;

    public function __construct(Stocks $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with('unit')->orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->with('unit')->findOrFail($id);
    }

    public function findBy($filled, $value)
    {
        $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $stockId = isset($attributes['id']) ? $attributes['id']: 0;
        return $this->model->updateOrCreate(['id' => $stockId], $attributes);
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
