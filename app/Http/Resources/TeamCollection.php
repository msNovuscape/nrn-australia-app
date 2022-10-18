<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Designation;
use App\Models\Period;
use App\Models\Setting;

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
        $designations = Designation::has('teams')->get();
        $periods = Period::has('teams')->orderBy('from_date', 'desc')->get();
        $settings = Setting::where('status', 1)->get();
        return [
            'teams' => $this->collection,
            'designations' => DesignationResource::collection($designations),
            'periods' => PeriodResource::collection($periods),
            'settings' => SettingResource::collection($settings),
            // 'states' => config('custom.states')
            
        ];
    }
}
