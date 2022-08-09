<?php

namespace App\Repositories\PurchaseOrder;
use App\Models\PurchaseOrder;

class PurchaseOrderEloquent implements PurchaseOrderRepository
{
    public $model;

    public function __construct(PurchaseOrder $model)
    {
        return $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['material','vendor', 'requisition', 'pack'])->orderBy('updated_at', 'desc')->get();
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
        $purchaseOrderId = isset($attributes['id']) ? $attributes['id'] : 0;
        if($purchaseOrderId == 0){
            foreach ($attributes['tableDatas'] as $data) {
                $lastSn = $this->model->orderBy('id', 'desc')->first();
                if($lastSn){
                    $lastSn = $lastSn->sn;
                }else{
                    $lastSn = 0;
                }
                $this->model->create([
                    'project_id' => $attributes['formData']['project_id'],
                    'sn' => str_pad($lastSn + 1, 5, '0', STR_PAD_LEFT),
                    'requisition_id' => $attributes['formData']['requisition_id'],
                    'date' => $attributes['formData']['date'],
                    'vendor_id' => $attributes['formData']['vendor_id'],
                    'material_id' => $data['material_id'],
                    'description' => $data['description'],
                    'quantity' => $data['quantity'],
                    'details' => $data['details'],
                    'pack_id' => $data['pack_id'],
                ]);
            }
            return true;
        }
        return $this->model->updateOrCreate(['id' => $purchaseOrderId], $attributes);
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
