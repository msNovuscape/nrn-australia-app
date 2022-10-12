<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\DocumentCategory;
use App\Models\Period;

class DocumentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories = DocumentCategory::has('documents')->get();
        $periods = Period::has('documents')->get();
        return [
            'data' => $this->collection,
            'categories' => DocumentCategoryResource::collection($categories),
            'periods' => PeriodResource::collection($periods),
        ];
    }
}
