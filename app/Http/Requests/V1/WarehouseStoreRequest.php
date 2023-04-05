<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class WarehouseStoreRequest extends FormRequest
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
            'code'                   => ['required', 'string', 'max:6', 'unique:warehouses,code'],
            'description'            => ['required', 'string', 'max:100', 'unique:warehouses,description'],
            'branch_id'              => ['required', 'integer', 'exists:branches,id'],
            'is_restrcited_sales'    => ['nullable', 'boolean'],
            'is_restrcited_purchase' => ['nullable', 'boolean'],
            'must_be_sync'           => ['required', 'boolean'],
            'sync_at'                => ['nullable'],
            'created_by'             => ['nullable'],
            'updated_by'             => ['nullable'],
        ];

    }

    protected function prepareForValidation()
    {
        if ($this->code) {
            $this->merge([ 'code' => Str::Upper($this->code), ]);
        }
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        if (strlen($this->isRestrictedSales)) {
            $this->merge([ 'is_restricted_sales' => $this->isRestrictedSales, ]);
        }
        if (strlen($this->isRestrictedPurchase)) {
            $this->merge([ 'is_restricted_purchase' => $this->isRestrictedPurchase, ]);
        }
        if (strlen($this->branchId)) {
            $this->merge([ 'branch_id' => $this->branchId, ]);
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
