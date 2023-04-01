<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'salesCommission'   => $this->sales_commission,
            'collectCommission' => $this->collect_commission,
            'login'             => $this->login,
            'lastLoginAt'       => $this->last_login_at,
            'mustBeSync'        => $this->must_be_sync,
            'syncAt'            => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'         => $this->created_at->toDateTimeString(),
            'updatedAt'         => $this->updated_at->toDateTimeString(),
            'customers'         => CustomerResource::collection($this->whenLoaded('customers')),

        ];
    }
}
