<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class InvoiceLineStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'invoice_id'                  => ['required', 'integer', 'exists:invoices,id'],
            'line_number'                 => ['required', 'integer'],
            'origin_document_type'        => ['required', 'string', 'max:1'],
            'origin_line_number'          => ['required', 'integer'],
            'article_id'                  => ['required', 'integer', 'exists:articles,id'],
            'warehouse_id'                => ['required', 'integer', 'exists:warehouses,id'],
            'sub_total'                   => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'qty'                         => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'qty_secondary_unit'          => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'pending'                     => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'sale_unit'                   => ['required', 'string', 'max:6'],
            'sale_price'                  => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'discounts'                   => ['required', 'string', 'max:15'],
            'tax_type'                    => ['required', 'string', 'max:1'],
            'net_line'                    => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'average_unit_cost'           => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'last_unit_cost'              => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'average_unit_cost_oc'        => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'last_unit_cost_oc'           => ['required', 'numeric', 'between:0.99999,9999999.99999'],
            'pay_back_amount'             => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'pay_back_total'              => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'sale_price_oc'               => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'article_generic_description' => ['nullable', 'string', 'max:60'],
            'comments'                    => ['nullable', 'string', 'max:100'],
            'total_units'                 => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'liqour_tax_amount'           => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'lot_number'                  => ['nullable', 'string', 'max:20'],
            'lot_date'                    => ['nullable'],
            'aux01'                       => ['nullable', 'numeric', 'between:0.99999,9999999.99999'],
            'aux02'                       => ['nullable', 'string', 'max:30'],
            'must_be_sync'                => ['required'],
            'sync_at'                     => ['nullable'],
            'created_by'                  => ['required', 'integer', 'exists:users,id'],
            'updated_by'                  => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->invoiceId) {
            $this->merge([ 'invoice_id' => $this->invoiceId, ]);
        }
        if (strlen($this->lineNumber)) {
            $this->merge([ 'line_number' => $this->lineNumber, ]);
        }
        if (strlen($this->originDocumentType)) {
            $this->merge([ 'origin_document_type' => $this->originDocumentType, ]);
        }
        if (strlen($this->originLineNumber)) {
            $this->merge([ 'origin_line_number' => $this->originLineNumber, ]);
        }
        if (strlen($this->articleId)) {
            $this->merge([ 'article_id' => $this->articleId, ]);
        }
        if (strlen($this->warehouseId)) {
            $this->merge([ 'warehouse_id' => $this->warehouseId, ]);
        }
        if (strlen($this->subTotal)) {
            $this->merge([ 'sub_total' => $this->subTotal, ]);
        }
        if (strlen($this->qtySecondaryUnit)) {
            $this->merge([ 'qty_secondary_unit' => $this->qtySecondaryUnit, ]);
        }
        if (strlen($this->saleUnit)) {
            $this->merge([ 'sale_unit' => $this->saleUnit, ]);
        }
        if (strlen($this->salePrice)) {
            $this->merge([ 'sale_price' => $this->salePrice, ]);
        }
        if (strlen($this->discounts)) {
            $this->merge([ 'discounts' => Str::upper($this->discounts), ]);
        }
        if (strlen($this->taxType)) {
            $this->merge([ 'tax_type' => $this->taxType, ]);
        }
        if (strlen($this->netLine)) {
            $this->merge([ 'net_line' => $this->netLine, ]);
        }
        if (strlen($this->averageUnitCost)) {
            $this->merge([ 'average_unit_cost' => $this->averageUnitCost, ]);
        }
        if (strlen($this->lastUnitCost)) {
            $this->merge([ 'last_unit_cost' => $this->lastUnitCost, ]);
        }
        if (strlen($this->averageUnitCostOc)) {
            $this->merge([ 'average_unit_cost_oc' => $this->averageUnitCostOc, ]);
        }
        if (strlen($this->lastUnitCostOc)) {
            $this->merge([ 'last_unit_cost_oc' => $this->lastUnitCostOc, ]);
        }
        if (strlen($this->payBackAmount)) {
            $this->merge([ 'pay_back_amount' => $this->payBackAmount, ]);
        }
        if (strlen($this->payBackTotal)) {
            $this->merge([ 'pay_back_total' => $this->payBackTotal, ]);
        }
        if (strlen($this->salePriceOc)) {
            $this->merge([ 'sale_price_oc' => $this->salePriceOc, ]);
        }
        if (strlen($this->articleGenericDescription)) {
            $this->merge([ 'article_generic_description' => $this->articleGenericDescription, ]);
        }
        if (strlen($this->comments)) {
            $this->merge([ 'comments' => Str::upper($this->comments), ]);
        }
        if (strlen($this->totalUnits)) {
            $this->merge([ 'total_units' => $this->totalUnits, ]);
        }
        if (strlen($this->liqourTaxAmount)) {
            $this->merge([ 'liqour_tax_amount' => $this->liqourTaxAmount, ]);
        }
        if (strlen($this->lotNumber)) {
            $this->merge([ 'lot_number' => $this->lotNumber, ]);
        }
        if (strlen($this->lotDate)) {
            $this->merge([ 'lot_date' => $this->lotDate, ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->createdBy) {
            $this->merge([
                'created_by' => $this->createdBy,
                'updated_by' => $this->createdBy,
            ]);
        }
    }

}
