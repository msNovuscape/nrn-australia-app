<?php

namespace App\Repositories\Receipt;
use App\Models\Receipt;
use App\Repositories\Receipt\ReceiptRepository;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;

class ReceiptEloquent implements ReceiptRepository
{
    public $model;

    public function __construct(Receipt $model)
    {
        return $this->model = $model;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['material','vendor', 'purchaseOrder', 'pack'])->orderBy('updated_at', 'desc')->get();
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
        $receiptId = isset($attributes['id']) ? $attributes['id'] : 0;
        if($receiptId == 0){
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
                    'purchase_order_id' => $attributes['formData']['purchase_order_id'],
                    'date' => $attributes['formData']['date'],
                    'vendor_id' => $attributes['formData']['vendor_id'],
                    'material_id' => $data['material_id'],
                    'description' => $data['description'],
                    'quantity' => $data['quantity'],
                    'details' => $data['details'],
                    'pack_id' => $data['pack_id'],
                    'base_name' => $data['base_name'],
                    'batch_no' => $data['batch_no']
                ]);
            }
            return true;
        }
        return $this->model->updateOrCreate(['id' => $receiptId], $attributes);
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

    public function transferMaterialFromProject(array $attributes)
    {
        $receipt_id = $attributes['receipt_id'];
        $project_id = $attributes['project_id'];
        $material_id = $attributes['material_id'];
        $quantity = $attributes['quantity'];
        $receipt = $this->model->where('id', $receipt_id)->first();
        $qty = $receipt->quantity;
        try{
            \DB::beginTransaction();
            $data = $this->model->create([
                'project_id' => $project_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'vendor_id' => $receipt->vendor_id,
                'pack_id' => $receipt->pack_id,
                'material_id' => $material_id,
                'description' => $receipt->description,
                'quantity' => $quantity,
                'base_name' => $receipt->base_name,
                'transfer_from_project' => $receipt->project_id
            ]);
            \DB::table('receipt')->where('id', $receipt_id)->update([
                'quantity' => $qty - $quantity
            ]);
            \DB::commit();
            return $data;
        }catch (\Exception $ex) {
            \DB::rollback();
            return $ex;
        }

    }
}
