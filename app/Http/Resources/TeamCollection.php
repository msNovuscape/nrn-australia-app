<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Designation;
use App\Models\Period;

class TeamCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
     public static $wrap = '';
    public function toArray($request)
    {
        $categories = Designation::has('teams')->get();
        $periods = Period::has('teams')->orderBy('from_date','desc')->get();
        return [
            'teams' => $this->collection,
            'designations' => DesignationResource::collection($categories),
            'periods' => PeriodResource::collection($periods),
            // 'states' => config('custom.states')
            
        ];
    }
}
