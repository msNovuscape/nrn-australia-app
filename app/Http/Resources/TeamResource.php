<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'image' => url($this->image),
            'full_name' => $this->full_name,
            'state' => intval($this->state_id),
            'team_type' => intval($this->team_type),
            'designation' =>  new DesignationResource($this->designation),
            'period' => new PeriodResource($this->period),
            
            
          
        ];
    }
}
