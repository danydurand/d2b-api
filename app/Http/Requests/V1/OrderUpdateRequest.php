<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'number'               => ['required', 'string', 'max:6', Rule::unique('orders')->ignore($this->id)],
                'customer_id'          => ['required', 'integer', 'exists:customers,id'],
                'seller_id'            => ['required', 'integer', 'exists:sellers,id'],
                'transport_id'         => ['required', 'integer', 'exists:transports,id'],
                'status'               => ['required', 'string', 'max:1'],
                'description'          => ['required', 'string', 'max:60'],
                'order_date'           => ['required'],
                'payment_condition_id' => ['required', 'integer', 'exists:payment_conditions,id'],
                'currency_id'          => ['required', 'integer', 'exists:currencies,id'],
                'due_date'             => ['nullable'],
                'comments'             => ['nullable', 'string', 'max:250'],
                'rate'                 => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'balance'              => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'gross_amount'         => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'net_amount'           => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'global_discount'      => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'total_surcharge'      => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'total_freight'        => ['nullable', 'numeric', 'between:0.01,9999999.99999'],
                'must_be_sync'         => ['required'],
                'sync_at'              => ['nullable'],
                'created_by'           => ['nullable'],
                'updated_by'           => ['nullable'],
            ];
        } else {
            return [
                'number'               => ['sometimes', 'required', 'string', 'max:6', Rule::unique('orders')->ignore($this->id)],
                'customer_id'          => ['sometimes', 'required', 'integer', 'exists:customers,id'],
                'seller_id'            => ['sometimes', 'required', 'integer', 'exists:sellers,id'],
                'transport_id'         => ['sometimes', 'required', 'integer', 'exists:transports,id'],
                'status'               => ['sometimes', 'required', 'string', 'max:1'],
                'description'          => ['sometimes', 'required', 'string', 'max:60'],
                'order_date'           => ['sometimes', 'required'],
                'payment_condition_id' => ['sometimes', 'required', 'integer', 'exists:payment_conditions,id'],
                'currency_id'          => ['sometimes', 'required', 'integer', 'exists:currencies,id'],
                'due_date'             => ['nullable'],
                'comments'             => ['nullable', 'string', 'max:250'],
                'rate'                 => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'balance'              => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'gross_amount'         => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'net_amount'           => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'global_discount'      => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'total_surcharge'      => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'total_freight'        => ['nullable', 'numeric', 'between:0.01,99999999.99999'],
                'must_be_sync'         => ['sometimes', 'required'],
                'sync_at'              => ['nullable'],
                'created_by'           => ['nullable'],
                'updated_by'           => ['nullable'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (strlen($this->customerId)) {
            $this->merge([ 'customer_id' => $this->customerId, ]);
        }
        if (strlen($this->sellerId)) {
            $this->merge([ 'seller_id' => $this->sellerId, ]);
        }
        if (strlen($this->transportId)) {
            $this->merge([ 'transport_id' => $this->transportId, ]);
        }
        if ($this->status) {
            $this->merge([ 'status' => Str::Upper($this->status), ]);
        }
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        if (strlen($this->orderDate)) {
            $this->merge([ 'order_date' => $this->orderDate, ]);
        }
        if (strlen($this->paymentConditionId)) {
            $this->merge([ 'payment_condition_id' => $this->paymentConditionId, ]);
        }
        if (strlen($this->currencyId)) {
            $this->merge([ 'currency_id' => $this->currencyId, ]);
        }
        if (strlen($this->comments)) {
            $this->merge([ 'comments' => Str::upper($this->comments), ]);
        }
        if (strlen($this->grossAmount)) {
            $this->merge([ 'gross_amount' => $this->grossAmount, ]);
        }
        if (strlen($this->netAmount)) {
            $this->merge([ 'net_amount' => $this->netAmount, ]);
        }
        if (strlen($this->globalDiscount)) {
            $this->merge([ 'global_discount' => $this->globalDiscount, ]);
        }
        if (strlen($this->totalSurcharge)) {
            $this->merge([ 'total_surcharge' => $this->totalSurchage, ]);
        }
        if (strlen($this->totalFreight)) {
            $this->merge([ 'total_freight' => $this->totalFreight, ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }

}
