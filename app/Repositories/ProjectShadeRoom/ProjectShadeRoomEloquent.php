<?php

namespace App\Repositories\ProjectShadeRoom;

use App\Models\ProjectShadeRoom;
use App\Models\ProjectShadeSurface;

class ProjectShadeRoomEloquent implements ProjectShadeRoomRepository
{
    protected $model;

    protected $surface;

    public function __construct(ProjectShadeRoom $model, ProjectShadeSurface $surface)
    {
        $this->model = $model;
        $this->surface = $surface;
    }

    public function all($projectId)
    {
        return $this->model->where('project_id', $projectId)->with(['project', 'shadeCard', 'surface'])->orderBy('updated_at', 'desc')->get();
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
        $formData = $attributes['formData'];

        $chosen_by = $formData['chosen_by'];
        unset($formData['chosen_by']);
        $chosen_date = $formData['chosen_date'];
        unset($formData['chosen_date']);
        $status = $formData['status'];
        unset($formData['status']);
        $approved_date = isset($formData['approved_date']) ? $formData['approved_date'] : null;
        unset($formData['approved_date']);
        $roomId = isset($formData['id']) ? $formData['id'] : 0;
        $room = $this->model->updateOrCreate(['id' => $roomId], $formData);
        if ($room) {
            if ($roomId > 0) {
                $this->surface->where('room_id', $room->id)->delete();
            }
            foreach ($attributes['tableDatas'] as $tableData) {
                if (isset($tableData['project_id']) && isset($tableData['surface_description'])
                    && isset($tableData['shade_palette_id']) && isset($tableData['material_id'])
                ) {
                    $tableData['room_id'] = $room->id;
                    $tableData['chosen_by'] = $chosen_by;
                    $tableData['chosen_date'] = $chosen_date;
                    $tableData['status'] = $status;
                    $tableData['approved_date'] = $approved_date;
                    $this->surface->create($tableData);
                }
            }
            return true;
        }
        foreach ($attributes as $attribute) {
            if (isset($attribute['project_id']) && isset($attribute['shade_card_id'])
                && isset($attribute['room_name'])) {
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
