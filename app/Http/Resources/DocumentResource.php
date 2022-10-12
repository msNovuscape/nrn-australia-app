<?php

namespace App\Http\Resources;

use App\Models\DocumentCategory;
use App\Models\Period;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories = DocumentCategory::has('documents')->get();
        $periods = Period::has('documents')->get();
        return [
            'id' => $this->id,
            'file' => url($this->file),
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'document_category' =>  new DocumentCategoryResource($this->document_category),
            'period' => new PeriodResource($this->period),
            'categories' => DocumentCategoryResource::collection($categories),
            'periods' => PeriodResource::collection($periods),
        ];
    }
}
