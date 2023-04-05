<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'code'                 => $this->code,
            'description'          => $this->description,
            'isRestrictedSales'    => $this->is_restricted_sales,
            'isRestrictedPurchase' => $this->is_restricted_purchase,
            'mustBeSync'           => $this->must_be_sync,
            'syncAt'               => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'            => $this->created_at->toDateTimeString(),
            'updatedAt'            => $this->updated_at->toDateTimeString(),
            // 'lines'                => LineResource::collection($this->whenLoaded('lines')),

        ];
    }
}
