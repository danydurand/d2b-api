<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\Api\InvoiceLineCollection;
use App\Http\Resources\Api\InvoiceLineResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                       => $this->id,
            'name'                     => $this->name,
            'fiscalNumber'             => $this->fiscal_number,
            'fiscalNumber2'            => $this->fiscal_number2,
            'customerId'               => $this->customer_id,
            'sellerId'                 => $this->seller_id,
            'transportId'              => $this->transport_id,
            'currencyId'               => $this->currency_id,
            'branchId'                 => $this->branch_id,
            'conditionPaymentId'       => $this->condition_payments_id,
            'controlNumber'            => $this->control_number,
            'status'                   => $this->status,
            'exchangeRate'             => $this->exchange_rate,
            'description'              => $this->description,
            'balance'                  => $this->balance,
            'billDate'                 => $this->bill_date,
            'dueDate'                  => $this->due_date,
            'comments'                 => $this->comments,
            'deliveryDddress'          => $this->delivery_address,
            'grossAmount'              => $this->gross_amount,
            'netAmount'                => $this->net_amount,
            'globalDiscountPercentage' => $this->global_discount_percentage,
            'globalDiscountAmount'     => $this->global_discount_amount,
            'surchargePercentage'      => $this->surcharge_percentage,
            'surchargeAmount'          => $this->surcharge_amount,
            'freightAmount'            => $this->freight_amount,
            'payPackAmount'            => $this->pay_back_amount,
            'taxAmount'                => $this->tax_amount,
            'payBackTaxAmount'         => $this->pay_back_tax_amount,
            'liqourTaxAmount'          => $this->liqour_tax_amount,
            'nullified'                => $this->nullified,
            'printed'                  => $this->printed,
            'field1'                   => $this->field1,
            'field2'                   => $this->field2,
            'field3'                   => $this->field3,
            'field4'                   => $this->field4,
            'field5'                   => $this->field5,
            'field6'                   => $this->field6,
            'field7'                   => $this->field7,
            'field8'                   => $this->field8,
            'other1'                   => $this->other1,
            'other2'                   => $this->other2,
            'other3'                   => $this->other3,
            'aux01'                    => $this->aux01,
            'aux02'                    => $this->aux02,
            'genericCustomerPhone'     => $this->generic_customer_phone,
            'mustBeSync'               => $this->must_be_sync,
            'syncAt'                   => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'                => $this->created_at->toDateTimeString(),
            'updatedAt'                => $this->updated_at->toDateTimeString(),
            'invoiceLines'             => InvoiceLineResource::collection($this->whenLoaded('invoiceLines')),
        ];
    }
}
