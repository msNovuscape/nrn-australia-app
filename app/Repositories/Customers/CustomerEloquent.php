<?php

namespace App\Repositories\Customers;


use App\Models\Customers;

class CustomerEloquent implements CustomerRepository
{
    private $model;

    public function __construct(Customers $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with('referral','parent')
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
        $customer_id = isset($attributes['id']) ? $attributes['id'] : 0;
        $attributes['name'] = ucwords($attributes['name']);
        $this->model->updateOrCreate([
            'id' => $customer_id
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

