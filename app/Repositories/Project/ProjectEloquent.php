<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Models\Products;
use App\Models\Customers;
use App\Models\Receipt;
use App\Models\Referrals;
use Carbon\Carbon;
use App\Models\ProjectHandOverDate;

class ProjectEloquent implements ProjectRepository
{
    public $model;
    public $handOverdate;

    public function __construct(Project $model, ProjectHandOverDate $handOverDate)
    {
        $this->model = $model;
        $this->handOverdate = $handOverDate;
    }

    public function all(array $attributes)
    {
        return $this->model->with('customer')
            ->when(isset($attributes['search']), function ($q) use ($attributes) {
                $q->where('name', 'like', '%' . $attributes['search'] . '%');
            })
            ->when(isset($attributes['status']), function ($q) use ($attributes) {
                if ($attributes['status'] == 'Sampling') {
                    $q->where('status', 'Sampling');
                }
                if ($attributes['status'] == 'OnGoing') {
                    $q->where('status', 'OnGoing');
                }
                if ($attributes['status'] == 'HandOver') {
                    $q->where('status', 'HandOver');
                }
            })
            ->orderBy('updated_at', 'desc')->paginate(50);
    }

    public function find($id)
    {
        return $this->model->with('customer', 'referral', 'employee','detail', 'customerReferral', 'handOverDate')->findorfail($id);
    }

    public function findBy($filled, $value)
    {
        return $this->model->where($filled, $value)->first();
    }

    public function store($attributes)
    {
        $projectId = isset($attributes['id']) ? $attributes['id']: 0;

        if($projectId == 0) {
            $attributes['status'] = 'Sampling';
        }
        $project = $this->model->updateOrCreate([
            'id' => $projectId
        ],$attributes);
        if($projectId == 0 && isset($attributes['sample_start_date'])) {
            $owner = (new Customers())->where('id', $project->customer_id)->first();
            $year = Carbon::parse($attributes['sample_start_date'])->format('y');
            $month = Carbon::parse($attributes['sample_start_date'])->format('m');
            $date = Carbon::parse($attributes['sample_start_date'])->format('d');
            $first = strtoupper($owner->name[0]);
            $last = strtoupper($attributes['address'][0]);
            $code = $month . $year . $date .  str_pad($project->id, 4, '0', STR_PAD_LEFT) . $first . $last;
            $project->code = $code;
            $name = explode(' ', $owner->name);
            $project->name = $name[0]. ',' . $project->address . '-' . $code;
            $project->save();
            return $project;
        }
        if($projectId > 0 && isset($attributes['address'])) {
            $owner = (new Customers())->where('id', $project->customer_id)->first();
            $year = Carbon::parse($attributes['sample_start_date'])->format('y');
            $month = Carbon::parse($attributes['sample_start_date'])->format('m');
            $date = Carbon::parse($attributes['sample_start_date'])->format('d');
            $first = strtoupper($owner->name[0]);
            $last = strtoupper($attributes['address'][0]);
            $code = $month . $year . $date .  str_pad($project->id, 4, '0', STR_PAD_LEFT) . $first . $last;
            $project->code = $code;
            $name = explode(' ', $owner->name);
            $project->name = $name[0]. ',' . $project->address . '-' . $code;
            $project->save();
        }
        if($projectId > 0 && isset($attributes['start_date'])){
            $project->status = 'OnGoing';
            $project->save();
        }
        if($projectId > 0 && isset($attributes['completed_date'])){
            $project->status = 'HandOver';
            $project->is_active = false;
            $project->save();
            $this->handOverdate->create(['project_id' => $project->id, 'handover_date' => $attributes['completed_date']]);
        }
        return $project;
    }

    public function update($attributes, $id)
    {
        $model =$this->find($id);
        $model->update($attributes);
        return $model;
    }
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function toggleProject($id)
    {
        $project = $this->model->find($id);
        $project->is_active = !$project->is_active;
        $project->status = 'OnGoing';
        $project->completed_date = null;
        return $project->save();
    }

    public function getTransferProjects($id)
    {
        $materialIds = (new Receipt())->where('id', $id)->pluck('material_id')->toArray();
        $materials = $this->model->whereIn('id', $materialIds)->get();
        return $materials;
    }
}
