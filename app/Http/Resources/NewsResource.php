<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'news_type' => $this->news_type,
            'image' => url($this->image),
            'mobile_image' => $this->mobile_image,
            'slug' => $this->slug,
            'featured_type' => intval($this->type),
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'nrna_news' =>  new NrnaNewsResource($this->nrn_news),
            'third_party_news' => new ThirdPartyNewsResource($this->third_party_news)
        ];
    }
}
