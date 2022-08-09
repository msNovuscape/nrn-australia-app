<?php

namespace App\Repositories\ProjectShadeSurface;

use App\Models\ProjectShadeSurface;

class ProjectShadeSurfaceEloquent implements ProjectShadeSurfaceRepository
{
    protected $model;

    public function __construct(ProjectShadeSurface $model)
    {
        $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['project', 'shadeCard', 'material'])->orderBy('updated_at', 'desc')->get();
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
        foreach ($attributes as $attribute) {
            if(isset($attribute['project_id']) && isset($attribute['shade_card_id'])
            && isset($attribute['surface_description']) && isset($attribute['shade_name'])
            && isset($attribute['shade_code'])) {
                $this->model->create($attribute);
            }
        }
        return true;
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
