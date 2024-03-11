<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'description'  => $this->description,
            'batch'        => $this->batch,
            'must_be_sync' => $this->must_be_sync,
            'sync_at'      => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'created_at'   => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at'   => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
            'sub_brands'   => SubBrandResource::collection($this->whenLoaded('subBrands')),
        ];
    }
}
