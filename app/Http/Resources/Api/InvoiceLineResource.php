<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'line_number' => $this->line_number,
            'origin_document_type' => $this->origin_document_type,
            'origin_line_number' => $this->origin_line_number,
            'article_id' => $this->article_id,
            'warehouse_id' => $this->warehouse_id,
            'sub_total' => $this->sub_total,
            'qty' => $this->qty,
            'qty_secondary_unit' => $this->qty_secondary_unit,
            'pending' => $this->pending,
            'sale_unit' => $this->sale_unit,
            'sale_price' => $this->sale_price,
            'discounts' => $this->discounts,
            'tax_type' => $this->tax_type,
            'net_line' => $this->net_line,
            'average_unit_cost' => $this->average_unit_cost,
            'last_unit_cost' => $this->last_unit_cost,
            'average_unit_cost_oc' => $this->average_unit_cost_oc,
            'last_unit_cost_oc' => $this->last_unit_cost_oc,
            'pay_back_amount' => $this->pay_back_amount,
            'pay_back_total' => $this->pay_back_total,
            'sale_price_oc' => $this->sale_price_oc,
            'article_generic_description' => $this->article_generic_description,
            'comments' => $this->comments,
            'total_units' => $this->total_units,
            'liqour_tax_amount' => $this->liqour_tax_amount,
            'lot_number' => $this->lot_number,
            'lot_date' => $this->lot_date,
            'aux01' => $this->aux01,
            'aux02' => $this->aux02,
            'must_be_sync' => $this->must_be_sync,
            'sync_at' => $this->sync_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
