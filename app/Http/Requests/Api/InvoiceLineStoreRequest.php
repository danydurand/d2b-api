<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'line_number' => ['required', 'integer'],
            'origin_document_type' => ['required', 'string', 'max:1'],
            'origin_line_number' => ['required', 'integer'],
            'article_id' => ['required', 'integer', 'exists:articles,id'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'sub_total' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'qty' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'qty_secondary_unit' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'pending' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'sale_unit' => ['required', 'string', 'max:6'],
            'sale_price' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'discounts' => ['required', 'string', 'max:15'],
            'tax_type' => ['required', 'string', 'max:1'],
            'net_line' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'average_unit_cost' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'last_unit_cost' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'average_unit_cost_oc' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'last_unit_cost_oc' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'pay_back_amount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'pay_back_total' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'sale_price_oc' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'article_generic_description' => ['nullable', 'string', 'max:60'],
            'comments' => ['nullable', 'string', 'max:100'],
            'total_units' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'liqour_tax_amount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'lot_number' => ['nullable', 'string', 'max:20'],
            'lot_date' => ['nullable'],
            'aux01' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'aux02' => ['nullable', 'string', 'max:30'],
            'must_be_sync' => ['required'],
            'sync_at' => ['nullable'],
            'created_by' => ['nullable'],
            'updated_by' => ['nullable'],
        ];
    }
}
