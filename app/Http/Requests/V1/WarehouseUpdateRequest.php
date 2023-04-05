<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WarehouseUpdateRequest extends FormRequest
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
        $id = Route::current()->parameter('warehouse')->id;

        if ($method == 'PUT') {
            return [
                'code'                   => ['required', 'string', 'max:6', Rule::unique('warehouses')->ignore($id)],
                'description'            => ['required', 'string', 'max:100', Rule::unique('warehouses')->ignore($id)],
                'branch_id'              => ['required', 'integer', 'exists:branches,id'],
                'is_restrcited_sales'    => ['required'],
                'is_restrcited_purchase' => ['required'],
                'must_be_sync'           => ['required'],
                'sync_at'                => ['nullable'],
                'created_by'             => ['nullable'],
                'updated_by'             => ['nullable'],
            ];
        } else {
            return [
                'code'                   => ['sometimes', 'required', 'string', 'max:6', Rule::unique('warehouses')->ignore($id)],
                'description'            => ['sometimes', 'required', 'string', 'max:100', Rule::unique('warehouses')->ignore($id)],
                'branch_id'              => ['sometimes', 'required', 'integer', 'exists:branches,id'],
                'is_restrcited_sales'    => ['sometimes', 'required', 'boolean'],
                'is_restrcited_purchase' => ['sometimes', 'required', 'boolean'],
                'must_be_sync'           => ['sometimes', 'required', 'boolean'],
                'sync_at'                => ['nullable'],
                'created_by'             => ['nullable'],
                'updated_by'             => ['nullable'],
            ];
        }
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
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }

}
