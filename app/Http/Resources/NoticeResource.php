<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'notice_type' => $this->notice_type,
            'image' => url($this->image),
            'mobile_image' => $this->mobile_image,
            'slug' => $this->slug,
            // 'featured_type' => intval($this->type),
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'nrna_notice' =>  new NrnaNoticeResource($this->nrn_notice),
            'third_party_notice' => new ThirdPartyNoticeResource($this->third_party_notice)
        ];
    }
}
