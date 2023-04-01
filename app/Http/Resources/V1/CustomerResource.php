<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'code'            => $this->code,
            'fiscalNumber'    => $this->fiscal_number,
            'businessName'    => $this->business_name,
            'customerTypeId'  => $this->customer_type_id,
            'sellerId'        => $this->seller_id,
            'fiscalAddress'   => $this->fiscal_address,
            'dispatchAddress' => $this->dispatch_address,
            'phones'          => $this->phones,
            'contactName'     => $this->contact_name,
            'mustBeSync'      => $this->must_be_sync,
            'syncAt'          => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'       => $this->created_at->toDateTimeString(),
            'updatedAt'       => $this->updated_at->toDateTimeString(),
        ];
    }
}
