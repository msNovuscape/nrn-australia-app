<?php

namespace App\Repositories\Products;


use App\Models\Products;

class ProductEloquent implements ProductRepository
{
    private $model;

    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with('category', 'process', 'units')
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('name', 'like', '%' . $attributes['search'] . '%');
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function find($id)
    {
        return $this->model->with('process')->findorfail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $productId = isset($attributes['id']) ? $attributes['id'] : 0;
        return $this->model->updateOrCreate([
            'id' => $productId
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

    public function getCategoryProduct($categoryId)
    {
        return $this->model->where('product_type_id', $categoryId)->orderBy('updated_at', 'desc')->get();
    }

    public function syncProcess(array $attributes)
    {
        $product = $this->find($attributes['productId']);
        return $product->process()->sync($attributes['processIds']);

    }
}

