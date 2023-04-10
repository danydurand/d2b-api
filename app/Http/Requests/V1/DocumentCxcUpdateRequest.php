<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class DocumentCxcUpdateRequest extends FormRequest
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
                'document_type_id'       => ['required', 'integer', 'exists:document_types,id'],
                'document_number'        => ['required', 'integer'],
                'nullified'              => ['required'],
                'control_number'         => ['required', 'integer'],
                'customer_id'            => ['required', 'integer', 'exists:customers,id'],
                'seller_id'              => ['required', 'integer', 'exists:sellers,id'],
                'branch_id'              => ['required', 'integer', 'exists:branches,id'],
                'is_tax_payer'           => ['required'],
                'document_date'          => ['required'],
                'due_date'               => ['required'],
                'tax_type'               => ['required', 'string', 'max:1'],
                'exchange_rate'          => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'currency_id'            => ['required', 'integer', 'exists:currencies,id'],
                'tax_amount'             => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'gross_amount'           => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'discounts'              => ['nullable', 'string', 'max:15'],
                'discount_amount'        => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'surcharge'              => ['nullable', 'string', 'max:15'],
                'surcharge_amount'       => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other_amount'           => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'net_amount'             => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'balance'                => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'liqour_tax_amount'      => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'comments'               => ['nullable', 'string'],
                'field1'                 => ['nullable', 'string', 'max:60'],
                'field2'                 => ['nullable', 'string', 'max:60'],
                'field3'                 => ['nullable', 'string', 'max:60'],
                'field4'                 => ['nullable', 'string', 'max:60'],
                'field5'                 => ['nullable', 'string', 'max:60'],
                'field6'                 => ['nullable', 'string', 'max:60'],
                'field7'                 => ['nullable', 'string', 'max:60'],
                'field8'                 => ['nullable', 'string', 'max:60'],
                'other1'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other2'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other3'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'aux01'                  => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'aux02'                  => ['nullable', 'string', 'max:30'],
                'record_date'            => ['required'],
                'must_be_sync'           => ['required'],
                'sync_at'                => ['nullable'],
                'created_by'             => ['nullable'],
                'updated_by'             => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'document_type_id'       => ['sometimes', 'required', 'integer', 'exists:document_types,id'],
                'document_number'        => ['sometimes', 'required', 'integer'],
                'nullified'              => ['sometimes', 'required'],
                'control_number'         => ['sometimes', 'required', 'integer'],
                'customer_id'            => ['sometimes', 'required', 'integer', 'exists:customers,id'],
                'seller_id'              => ['sometimes', 'required', 'integer', 'exists:sellers,id'],
                'branch_id'              => ['sometimes', 'required', 'integer', 'exists:branches,id'],
                'is_tax_payer'           => ['sometimes', 'required'],
                'document_date'          => ['sometimes', 'required'],
                'due_date'               => ['sometimes', 'required'],
                'tax_type'               => ['sometimes', 'required', 'string', 'max:1'],
                'exchange_rate'          => ['sometimes', 'required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'currency_id'            => ['sometimes', 'required', 'integer', 'exists:currencies,id'],
                'tax_amount'             => ['sometimes', 'required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'gross_amount'           => ['sometimes', 'required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'discounts'              => ['nullable', 'string', 'max:15'],
                'discount_amount'        => ['sometimes', 'required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'surcharge'              => ['nullable', 'string', 'max:15'],
                'surcharge_amount'       => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other_amount'           => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'net_amount'             => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'balance'                => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'liqour_tax_amount'      => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'comments'               => ['nullable', 'string'],
                'field1'                 => ['nullable', 'string', 'max:60'],
                'field2'                 => ['nullable', 'string', 'max:60'],
                'field3'                 => ['nullable', 'string', 'max:60'],
                'field4'                 => ['nullable', 'string', 'max:60'],
                'field5'                 => ['nullable', 'string', 'max:60'],
                'field6'                 => ['nullable', 'string', 'max:60'],
                'field7'                 => ['nullable', 'string', 'max:60'],
                'field8'                 => ['nullable', 'string', 'max:60'],
                'other1'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other2'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'other3'                 => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'aux01'                  => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
                'aux02'                  => ['nullable', 'string', 'max:30'],
                'record_date'            => ['sometimes', 'required'],
                'must_be_sync'           => ['sometimes', 'required'],
                'sync_at'                => ['nullable'],
                'created_by'             => ['nullable'],
                'updated_by'             => ['required', 'integer', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->documentTypeId) {
            $this->merge([ 'document_type_id' => $this->documentTypeId, ]);
        }
        if (strlen($this->documentNumber)) {
            $this->merge([ 'document_number' => Str::upper($this->documentNumber), ]);
        }
        if (strlen($this->controlNumber)) {
            $this->merge([ 'control_number' => Str::upper($this->controlNumber), ]);
        }
        if (strlen($this->customerId)) {
            $this->merge([ 'customer_id' => $this->customerId, ]);
        }
        if (strlen($this->sellerId)) {
            $this->merge([ 'seller_id' => $this->sellerId, ]);
        }
        if (strlen($this->branchId)) {
            $this->merge([ 'branch_id' => $this->branchId, ]);
        }
        if (strlen($this->currencyId)) {
            $this->merge([ 'currency_id' => $this->currencyId, ]);
        }
        if (strlen($this->isTaxPayer)) {
            $this->merge([ 'is_tax_payer' => $this->isTaxPayer, ]);
        }
        if (strlen($this->documentDate)) {
            $this->merge([ 'document_date' => $this->documentDate, ]);
        }
        if (strlen($this->dueDate)) {
            $this->merge([ 'due_date' => $this->dueDate, ]);
        }
        if (strlen($this->taxType)) {
            $this->merge([ 'branch_id' => $this->taxType, ]);
        }
        if (strlen($this->exchangeRate)) {
            $this->merge([ 'exchange_rate' => $this->exchangeRate, ]);
        }
        if (strlen($this->currencyId)) {
            $this->merge([ 'currency_id' => $this->currencyId, ]);
        }
        if (strlen($this->taxAmount)) {
            $this->merge([ 'tax_amount' => $this->taxAmount, ]);
        }
        if (strlen($this->grossAmount)) {
            $this->merge([ 'gross_amount' => $this->grossAmount, ]);
        }
        if (strlen($this->discountAmount)) {
            $this->merge([ 'discount_amount' => $this->discountAmount, ]);
        }
        if (strlen($this->surchargeAmount)) {
            $this->merge([ 'surcharge_amount' => $this->surchargeAmount, ]);
        }
        if (strlen($this->otherAmount)) {
            $this->merge([ 'other_amount' => $this->otherAmount, ]);
        }
        if (strlen($this->netAmount)) {
            $this->merge([ 'net_amount' => $this->netAmount, ]);
        }
        if (strlen($this->liqourtaxAmount)) {
            $this->merge([ 'liqour_tax_amount' => $this->liqourtaxAmount, ]);
        }
        if (strlen($this->recordDate)) {
            $this->merge([ 'record_date' => $this->recordDate, ]);
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
