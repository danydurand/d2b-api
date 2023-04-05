<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderLineUpdateRequest extends FormRequest
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
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'line_number' => ['required', 'integer'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'article_id' => ['required', 'integer', 'exists:articles,id'],
            'qty' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'sale_price' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'sale_price2' => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'net_amount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'must_be_sync' => ['required'],
            'sync_at' => ['nullable'],
            'created_by' => ['nullable'],
            'updated_by' => ['nullable'],
        ];
    }
}
