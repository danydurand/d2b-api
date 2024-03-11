<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'code'         => $this->code,
            'description'  => $this->description,
            'must_be_sync' => $this->must_be_sync,
            'batch'        => $this->batch,
            'sync_at'      => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
