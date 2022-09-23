<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'date' => $this->date,
            'title' => $this->title,
            'images' => GalleryImageResource::collection($this->whenLoaded('gallery_images')->slice(0,3)),

            // 'images' =>  new GalleryImageResource($this->gallery_images),
            // 'third_party_news' => new ThirdPartyNewsResource($this->third_party_news)
        ];
    }
}
