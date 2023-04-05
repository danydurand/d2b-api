<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'orderId'     => $this->order_id,
            'lineNumber'  => $this->line_number,
            'warehouseId' => $this->warehouse_id,
            'articleId'   => $this->article_id,
            'qty'         => $this->qty,
            'salePrice'   => $this->sale_price,
            'salePrice2'  => $this->sale_price2,
            'netAmount'   => $this->net_amount,
            'mustBeSync'  => $this->must_be_sync,
            'syncSt'      => $this->sync_at,
            'createdBy'   => $this->created_by,
            'updatedBy'   => $this->updated_by,
        ];
    }
}
