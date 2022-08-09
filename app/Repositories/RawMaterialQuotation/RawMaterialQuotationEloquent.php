<?php

namespace App\Repositories\RawMaterialQuotation;
use App\Models\RawMaterialQuotation;

class RawMaterialQuotationEloquent implements RawMaterialQuotationRepository
{
    public $model;

    public function __construct(RawMaterialQuotation $model)
    {
        return $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['vendor','material', 'pack'])->orderBy('updated_at', 'desc')->get();
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
        $quotationId = isset($attributes['id']) ? $attributes['id'] : 0;
        if($quotationId == 0){
            foreach ($attributes['tableDatas'] as $data) {
                $this->model->create([
                    'project_id' => $attributes['formData']['project_id'],
                    'material_id' => $data['material_id'],
                    'pack_id' => $data['pack_id'],
                    'rate' => $data['rate'],
                    'vendor_id' => $attributes['formData']['vendor_id'],
                    'effective_from' => $attributes['formData']['effective_from']
                ]);
            }
            return true;
        }
        return $this->model->updateOrCreate(['id' => $quotationId], $attributes);
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
