<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubBrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'brandId'     => $this->brand_id,
            'description' => $this->description,
            'mustBeSync'  => $this->must_be_sync,
            'syncAt'      => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'   => $this->created_at->toDateTimeString(),
            'updatedAt'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
