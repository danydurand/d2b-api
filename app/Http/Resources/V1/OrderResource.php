<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'number'             => $this->number,
            'customerId'         => $this->customer_id,
            'sellerId'           => $this->seller_id,
            'transportId'        => $this->transport_id,
            'status'             => $this->status,
            'description'        => $this->description,
            'orderDate'          => $this->order_date,
            'paymentConditionId' => $this->payment_condition_id,
            'currencyId'         => $this->currency_id,
            'dueDate'            => $this->due_date,
            'comments'           => $this->comments,
            'rate'               => $this->rate,
            'balance'            => $this->balance,
            'grossAmount'        => $this->gross_amount,
            'netAmount'          => $this->net_amount,
            'globalDiscount'     => $this->global_discount,
            'totalSurcharge'     => $this->total_surcharge,
            'totalFreight'       => $this->total_freight,
            'mustBeSync'         => $this->must_be_sync,
            'syncSt'             => $this->sync_at,
            'createdBy'          => $this->created_by,
            'updatedBy'          => $this->updated_by,
            'orderLines'         => OrderLineResource::collection($this->whenLoaded('orderLines')),
        ];
    }
}
