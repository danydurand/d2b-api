<?php

namespace App\Http\Resources\V1;

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
            'id'                        => $this->id,
            'invoiceId'                 => $this->invoice_id,
            'lineNumber'                => $this->line_number,
            'originDocumentType'        => $this->origin_document_type,
            'originLineNumber'          => $this->origin_line_number,
            'articleId'                 => $this->article_id,
            'warehouseId'               => $this->warehouse_id,
            'subTotal'                  => $this->sub_total,
            'qty'                       => $this->qty,
            'qtySecondaryUnit'          => $this->qty_secondary_unit,
            'pending'                   => $this->pending,
            'saleUnit'                  => $this->sale_unit,
            'salePrice'                 => $this->sale_price,
            'discounts'                 => $this->discounts,
            'taxType'                   => $this->tax_type,
            'netLine'                   => $this->net_line,
            'averageUnitCost'           => $this->average_unit_cost,
            'lastUnitCost'              => $this->last_unit_cost,
            'averageUnitCostOc'         => $this->average_unit_cost_oc,
            'lastUnitCostOc'            => $this->last_unit_cost_oc,
            'payBackAmount'             => $this->pay_back_amount,
            'payBackTotal'              => $this->pay_back_total,
            'salePriceOc'               => $this->sale_price_oc,
            'articleGenericDescription' => $this->article_generic_description,
            'comments'                  => $this->comments,
            'totalUnits'                => $this->total_units,
            'liqourTaxAmount'           => $this->liqour_tax_amount,
            'lotNumber'                 => $this->lot_number,
            'lotDate'                   => $this->lot_date,
            'aux01'                     => $this->aux01,
            'aux02'                     => $this->aux02,
            'mustBeSync'                => $this->must_be_sync,
            'syncAt'                    => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'                 => $this->created_at->toDateTimeString(),
            'updatedAt'                 => $this->updated_at->toDateTimeString(),
        ];
    }
}
