<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentCxcResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'documentTypeId'  => $this->document_type_id,
            'documentNumber'  => $this->document_number,
            'nullified'       => $this->nullified,
            'controlNumber'   => $this->control_number,
            'customerId'      => $this->customer_id,
            'sellerId'        => $this->seller_id,
            'branchId'        => $this->branch_id,
            'isTaxPayer'      => $this->is_tax_payer,
            'documentDate'    => $this->document_date->toDateTimeString(),
            'dueDate'         => $this->due_date->toDateTimeString(),
            'taxType'         => $this->tax_type,
            'exchangeRate'    => $this->exchange_rate,
            'currencyId'      => $this->currency_id,
            'taxAmount'       => $this->tax_amount,
            'grossAmount'     => $this->gross_amount,
            'discounts'       => $this->discounts,
            'discountAmount'  => $this->discount_amount,
            'surcharge'       => $this->surcharge,
            'surchargeAmount' => $this->surcharge_amount,
            'otherAmount'     => $this->other_amount,
            'netAmount'       => $this->net_amount,
            'balance'         => $this->balance,
            'liqourTaxAmount' => $this->liqour_tax_amount,
            'comments'        => $this->comments,
            'field1'          => $this->field1,
            'field2'          => $this->field2,
            'field3'          => $this->field3,
            'field4'          => $this->field4,
            'field5'          => $this->field5,
            'field6'          => $this->field6,
            'field7'          => $this->field7,
            'field8'          => $this->field8,
            'other1'          => $this->other1,
            'other2'          => $this->other2,
            'other3'          => $this->other3,
            'aux01'           => $this->aux01,
            'aux02'           => $this->aux02,
            'recordDate'      => $this->record_date->toDateTimeString(),
            'createdAt'       => $this->created_at->toDateTimeString(),
            'updatedAt'       => $this->updated_at->toDateTimeString(),
            'createdBy'       => $this->creator,
            'updatedBy'       => $this->updator,
        ];
    }
}
