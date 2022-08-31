<?php

namespace App\Repositories\News;


use App\Models\News;

class NewsEloquent implements NewsRepository
{
    private $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model
            ->when(isset($attributes['status']), function ($q) use ($attributes) {
                if ($attributes['status'] == 'active') {
                    $q->where('is_active', 1);
                }
                if ($attributes['status'] == 'deactive') {
                    $q->where('is_active', 2);
                }
            })
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('title', 'like', '%' . $attributes['search'] . '%');
            })
            ->orderBy('updated_at', 'desc')->paginate(10);
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
        $referral_id = isset($attributes['id']) ? $attributes['id'] : 0;
        $this->model->updateOrCreate([
            'id' => $referral_id
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

