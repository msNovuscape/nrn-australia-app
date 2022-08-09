<?php

namespace App\Repositories\Materials;


use App\Models\Materials;
use App\Models\MaterialAlternativeUnit;
use App\Models\PackType;
use App\Models\Receipt;
use App\Models\Unit;

class MaterialEloquent implements MaterialRepository
{
    private $model;
    private $alternativeUnit;

    public function __construct(Materials $model, MaterialAlternativeUnit $alternativeUnit)
    {
        $this->model = $model;
        $this->alternativeUnit = $alternativeUnit;
    }

    public function all(array $attributes)
    {
        return $this->model->with('category', 'unit', 'manufacture', 'alternativeUnits', 'group')
            ->when(isset($attributes['type']), function ($q) use ($attributes) {
                if ($attributes['type'] == 'active') {
                    $q->where('is_active', 1);
                }
                if ($attributes['type'] == 'inactive') {
                    $q->where('is_active', 0);
                }
            })
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('name', 'like', '%' . $attributes['search'] . '%');
            })
            ->orderBy('updated_at', 'desc')->get();
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
        $formData = $attributes['formData'];
        $materialId = isset($formData['id']) ? $formData['id'] : 0;
        $material = $this->model->updateOrCreate(['id' => $materialId], $formData);
        if ($material) {
            $unit = (new Unit())->where('id', $formData['unit_id'])->first();
            if ($materialId > 0) {
                $this->alternativeUnit->where('material_id', $material->id)->delete();
            }
            foreach ($attributes['tableDatas'] as $tableData) {
                if ($tableData['pack_id'] && $tableData['multiple_of_unit']) {
                    $packType = (new PackType())->where('id', $tableData['pack_id'])->first();
                    $tableData['material_id'] = $material->id;
                    $tableData['pack_size'] = $packType->name . ' of ' . $tableData['multiple_of_unit'] . ' ' . $unit->code;
                    $tableData['pack_code'] = $packType->code;
                    $this->alternativeUnit->create($tableData);
                }
            }
        }
        return true;
    }

    public function update($attributes, $id)
    {
        $model = $this->model->findorfail($id);
        $model->update($attributes);
        return $model;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function getTransferMaterials($id)
    {
       $materialIds = (new Receipt())->where('id', $id)->pluck('material_id')->toArray();
       $materials = $this->model->whereIn('id', $materialIds)->get();
       return $materials;
    }
}

