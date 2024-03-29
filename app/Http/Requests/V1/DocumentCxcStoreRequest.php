<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class DocumentCxcStoreRequest extends FormRequest
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
            'documentTypeId'  => ['required', 'integer', 'exists:document_types,id'],
            'documentNumber'  => ['required', 'integer'],
            'nullified'       => ['required'],
            'controlNumber'   => ['required', 'integer'],
            'customerId'      => ['required', 'integer', 'exists:customers,id'],
            'sellerId'        => ['required', 'integer', 'exists:sellers,id'],
            'branchId'        => ['required', 'integer', 'exists:branches,id'],
            'isTaxPayer'      => ['required'],
            'documentDate'    => ['required'],
            'dueDate'         => ['required'],
            'taxType'         => ['required', 'string', 'max:1'],
            'exchangeRate'    => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'currencyId'      => ['required', 'integer', 'exists:currencies,id'],
            'taxAmount'       => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'grossAmount'     => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'discounts'       => ['nullable', 'string', 'max:15'],
            'discountAmount'  => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'surcharge'       => ['nullable', 'string', 'max:15'],
            'surchargeAmount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'otherAmount'     => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'netAmount'       => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'balance'         => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'liqourTaxAmount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'comments'        => ['nullable', 'string'],
            'field1'          => ['nullable', 'string', 'max:60'],
            'field2'          => ['nullable', 'string', 'max:60'],
            'field3'          => ['nullable', 'string', 'max:60'],
            'field4'          => ['nullable', 'string', 'max:60'],
            'field5'          => ['nullable', 'string', 'max:60'],
            'field6'          => ['nullable', 'string', 'max:60'],
            'field7'          => ['nullable', 'string', 'max:60'],
            'field8'          => ['nullable', 'string', 'max:60'],
            'other1'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'other2'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'other3'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'aux01'           => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            'aux02'           => ['nullable', 'string', 'max:30'],
            'recordDate'      => ['required'],
            'mustBeSync'      => ['required'],
            'syncAt'          => ['nullable'],
            'createdBy'       => ['required', 'integer', 'exists:users,id'],
            'updatedBy'       => ['nullable'],
        ];
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
            $this->merge([ 'tax_type' => $this->taxType, ]);
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
