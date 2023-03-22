<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'description' => $this->description,
            'priceListId' => $this->price_list_id,
            'priceList' => $this->price_list_name,
            'mustBeSync' => $this->must_be_sync,
            'syncAt' => $this->sync_at,
            'createdAt' => $this->created_at->toDateTimeString(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
            'createdBy' => $this->creator,
            'updatedBy' => $this->updator,
        ];
    }
}
