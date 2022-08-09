<?php

namespace App\Repositories\ProjectDetail;

use App\Models\ProjectDetail;

class ProjectDetailEloquent implements ProjectDetailRepository
{
    public $model;

    public function __construct(ProjectDetail $model)
    {
        $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['category', 'product','product.units', 'employee', 'contract'])
            ->orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
        return $this->model->with('category', 'product', 'product.units', 'employee', 'contract')->findOrFail($id);
    }

    public function findBy($filled, $value)
    {
        $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $detailId = isset($attributes['id']) ? $attributes['id']: 0;
        return $this->model->updateOrCreate(['id' => $detailId], $attributes);
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
