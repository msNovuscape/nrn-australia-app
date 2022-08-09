<?php

namespace App\Repositories\ShadePalette;

use App\Models\ShadePalette;

class ShadePaletteEloquent implements ShadePaletteRepository
{
    protected $model;

    public function __construct(ShadePalette $model)
    {
        $this->model = $model;
    }

    public function all(array $attributes)
    {
        return $this->model->with(['shadeCard','shadeCard.manufacture'])->orderBy('updated_at', 'desc')->get();
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
        if ($unitId == 0 ) {
            foreach ($attributes['tableDatas'] as $data) {
                $this->model->create([
                    'shade_id' => $attributes['formData']['shade_id'],
                    'page_no' => $attributes['formData']['page_no'],
                    'shade_name' => $data['shade_name'],
                    'shade_code' => $data['shade_code']
                ]);
            }
            return true;
        }
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
