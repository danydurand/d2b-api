<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OrderBulkStoreRequest extends FormRequest
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
            '*.number'             => ['required', 'string', 'max:6', 'unique:orders,number'],
            '*.customerId'         => ['required', 'integer', 'exists:customers,id'],
            '*.sellerId'           => ['required', 'integer', 'exists:sellers,id'],
            '*.transportId'        => ['required', 'integer', 'exists:transports,id'],
            '*.status'             => ['required', 'string', 'max:1'],
            '*.description'        => ['required', 'string', 'max:60'],
            '*.orderDate'          => ['required'],
            '*.paymentConditionId' => ['required', 'integer', 'exists:payment_conditions,id'],
            '*.currencyId'         => ['required', 'integer', 'exists:currencies,id'],
            '*.dueDate'            => ['nullable'],
            '*.comments'           => ['nullable', 'string', 'max:250'],
            '*.rate'               => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.balance'            => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.grossAmount'        => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.netAmount'          => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.globalDiscount'     => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.totalSurcharge'     => ['nullable', 'numeric', 'between:0.01,999999.99999'],
            '*.totalFreight'       => ['nullable', 'numeric', 'between:0.01,999999.99999'],
        ];
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
        $this->merge([
            'must_by_sync' => false,
            'sync_at'      => Carbon::now()->toDateTimeString(),
            'created_by'   => 1,
            'created_at'   => Carbon::now()->toDateTimeString(),
        ]);
    }

}
