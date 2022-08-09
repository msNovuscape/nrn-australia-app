<?php

namespace App\Repositories\Requisition;
use App\Models\Requisition;

class RequisitionEloquent implements RequisitionRepository
{
    public $model;

    public function __construct(Requisition $model)
    {
        return $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['material'])->orderBy('updated_at', 'desc')->get();
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
        $requisitionId = isset($attributes['id']) ? $attributes['id'] : 0;
        if($requisitionId == 0){
            foreach ($attributes['tableDatas'] as $data) {
                $lastSn = $this->model->orderBy('id', 'desc')->first();
                if($lastSn){
                    $lastSn = $lastSn->sn;
                }else{
                    $lastSn = 0;
                }
                $this->model->create([
                    'project_id' => $attributes['formData']['project_id'],
                    'sn' => str_pad($lastSn + 1, 5, 0, STR_PAD_LEFT),
                    'material_id' => $data['material_id'],
                    'description' => $data['description'],
                    'quantity' => $data['quantity'],
                    'detail' => $data['detail'],
                    'required_date' => $data['required_date'],
                    'entry_date' => $attributes['formData']['entry_date'],
                    'slip_received_date' => $attributes['formData']['slip_received_date'],

                ]);
            }
            return true;
        }
        return $this->model->updateOrCreate(['id' => $requisitionId], $attributes);
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
