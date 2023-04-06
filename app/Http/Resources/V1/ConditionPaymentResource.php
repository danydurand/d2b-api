<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConditionPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'description' => $this->description,
            'branchId'    => $this->branch_id,
            'creditDays'  => $this->credit_days,
            'field1'      => $this->field1,
            'field2'      => $this->field2,
            'field3'      => $this->field3,
            'field4'      => $this->field4,
            'mustBeSync'  => $this->must_be_sync,
            'syncAt'      => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'   => $this->created_at->toDateTimeString(),
            'updatedAt'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
