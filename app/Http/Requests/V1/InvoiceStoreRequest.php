<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class InvoiceStoreRequest extends FormRequest
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
            'name'                       => ['required', 'string', 'max:60'],
            'fiscal_number'              => ['required', 'string', 'max:18'],
            'fiscal_number2'             => ['required', 'string', 'max:18'],
            'customer_id'                => ['required', 'integer', 'exists:customers,id'],
            'seller_id'                  => ['required', 'integer', 'exists:sellers,id'],
            'transport_id'               => ['required', 'integer', 'exists:transports,id'],
            'currency_id'                => ['required', 'integer', 'exists:currencies,id'],
            'branch_id'                  => ['required', 'integer', 'exists:branches,id'],
            'condition_payment_id'       => ['required', 'integer', 'exists:condition_payments,id'],
            'control_number'             => ['required', 'integer'],
            'status'                     => ['required', 'string', 'max:1'],
            'exchange_rate'              => ['required', 'numeric', 'between:0.01,999.99999'],
            'description'                => ['nullable', 'string', 'max:60'],
            'balance'                    => ['required', 'numeric', 'between:0.01,99999.99999'],
            'bill_date'                  => ['required'],
            'due_date'                   => ['required'],
            'comments'                   => ['nullable', 'string'],
            'delivery_address'           => ['nullable', 'string'],
            'gross_amount'               => ['required', 'numeric', 'between:0.01,99999.99999'],
            'net_amount'                 => ['required', 'numeric', 'between:0.01,99999.99999'],
            'global_discount_percentage' => ['nullable', 'string', 'max:15'],
            'global_discount_amount'     => ['nullable', 'numeric', 'between:0.01,999.99999'],
            'surcharge_percentage'       => ['nullable', 'string', 'max:15'],
            'surcharge_amount'           => ['nullable', 'numeric', 'between:0.01,99999.99999'],
            'freight_amount'             => ['nullable', 'numeric', 'between:0.01,99999.99999'],
            'pay_back_amount'            => ['nullable', 'numeric', 'between:0.01,99999.99999'],
            'tax_amount'                 => ['nullable', 'numeric', 'between:0.01,999.99999'],
            'pay_back_tax_amount'        => ['nullable', 'numeric', 'between:0.01,999.99999'],
            'liqour_tax_amount'          => ['nullable', 'numeric', 'between:0.01,999.99999'],
            'nullified'                  => ['nullable'],
            'printed'                    => ['nullable'],
            'field1'                     => ['nullable', 'string', 'max:60'],
            'field2'                     => ['nullable', 'string', 'max:60'],
            'field3'                     => ['nullable', 'string', 'max:60'],
            'field4'                     => ['nullable', 'string', 'max:60'],
            'field5'                     => ['nullable', 'string', 'max:60'],
            'field6'                     => ['nullable', 'string', 'max:60'],
            'field7'                     => ['nullable', 'string', 'max:60'],
            'field8'                     => ['nullable', 'string', 'max:60'],
            'other1'                     => ['nullable', 'numeric', 'between:-9999.99999,99999.99999'],
            'other2'                     => ['nullable', 'numeric', 'between:-9999.99999,99999.99999'],
            'other3'                     => ['nullable', 'numeric', 'between:-9999.99999,99999.99999'],
            'aux01'                      => ['nullable', 'numeric', 'between:-9999.99999,99999.99999'],
            'aux02'                      => ['nullable', 'string', 'max:30'],
            'generic_customer_phone'     => ['nullable', 'string', 'max:30'],
            'must_be_sync'               => ['required'],
            'sync_at'                    => ['nullable'],
            'created_by'                 => ['required', 'integer', 'exists:users,id'],
            'updated_by'                 => ['nullable'],
        ];
    }
    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge([ 'name' => Str::Upper($this->name), ]);
        }
        if (strlen($this->fiscalNumber)) {
            $this->merge([ 'fiscal_number' => Str::upper($this->fiscalNumber), ]);
        }
        if (strlen($this->fiscalNumber2)) {
            $this->merge([ 'fiscal_number2' => Str::upper($this->fiscalNumber2), ]);
        }
        if (strlen($this->customerId)) {
            $this->merge([ 'customer_id' => $this->customerId, ]);
        }
        if (strlen($this->sellerId)) {
            $this->merge([ 'seller_id' => $this->sellerId, ]);
        }
        if (strlen($this->transportId)) {
            $this->merge([ 'transport_id' => $this->transportId, ]);
        }
        if (strlen($this->currencyId)) {
            $this->merge([ 'currency_id' => $this->currencyId, ]);
        }
        if (strlen($this->branchId)) {
            $this->merge([ 'branch_id' => $this->branchId, ]);
        }
        if (strlen($this->conditionPaymentId)) {
            $this->merge([ 'condition_payment_id' => $this->conditionPaymentId, ]);
        }
        if (strlen($this->controlNumber)) {
            $this->merge([ 'control_number' => $this->controlNumber, ]);
        }
        if (strlen($this->exchangeRate)) {
            $this->merge([ 'exchange_rate' => $this->exchangeRate, ]);
        }
        if (strlen($this->billDate)) {
            $this->merge([ 'bill_date' => $this->billDate, ]);
        }
        if (strlen($this->dueDate)) {
            $this->merge([ 'due_date' => $this->dueDate, ]);
        }
        if (strlen($this->deliveryAddress)) {
            $this->merge([ 'delivery_address' => Str::Upper($this->deliveryAddress), ]);
        }
        if (strlen($this->grossAmount)) {
            $this->merge([ 'gross_amount' => $this->grossAmount, ]);
        }
        if (strlen($this->netAmount)) {
            $this->merge([ 'net_amount' => $this->netAmount, ]);
        }
        if (strlen($this->globalDiscountPercentage)) {
            $this->merge([ 'global_discount_percentage' => $this->globalDiscountPercentage, ]);
        }
        if (strlen($this->globalDiscountAmount)) {
            $this->merge([ 'global_discount_amount' => $this->globalDiscountAmount, ]);
        }
        if (strlen($this->surchargeDiscountPercentage)) {
            $this->merge([ 'surcharge_discount_percentage' => $this->surchargeDiscountPercentage, ]);
        }
        if (strlen($this->globalDiscountAmount)) {
            $this->merge([ 'global_discount_amount' => $this->globalDiscountAmount, ]);
        }
        if (strlen($this->freightAmount)) {
            $this->merge([ 'freight_amount' => $this->freightAmount, ]);
        }
        if (strlen($this->payBackAmount)) {
            $this->merge([ 'pay_back_amount' => $this->payBackAmount, ]);
        }
        if (strlen($this->taxAmount)) {
            $this->merge([ 'tax_amount' => $this->taxAmount, ]);
        }
        if (strlen($this->payBackTaxAmount)) {
            $this->merge([ 'pay_back_tax_amount' => $this->payBackTaxAmount, ]);
        }
        if (strlen($this->liqourtaxAmount)) {
            $this->merge([ 'liqour_tax_amount' => $this->liqourtaxAmount, ]);
        }
        if (strlen($this->genericCustomerPhone)) {
            $this->merge([ 'generic_customer_phone' => $this->genericCustomerPhone, ]);
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
