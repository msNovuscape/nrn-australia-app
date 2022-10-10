<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'project_type' => $this->project_type,
            'image' => url($this->image),
            'mobile_image' => $this->mobile_image,
            'slug' => $this->slug,
            // 'featured_type' => intval($this->type),
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'nrna_project' =>  new NrnaProjectResource($this->nrn_project),
            'third_party_project' => new ThirdPartyProjectResource($this->third_party_project)
        ];
    }
}
