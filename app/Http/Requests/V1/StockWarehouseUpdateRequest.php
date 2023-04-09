<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StockWarehouseUpdateRequest extends FormRequest
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
                'warehouse_id'       => ['required', 'integer', 'exists:warehouses,id'],
                'article_id'         => ['required', 'integer', 'exists:articles,id'],
                'actual_stock'       => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'actual_sstock'      => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'commited_stock'     => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'commited_sstock'    => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_arrive_stock'    => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_arrive_sstock'   => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_dispatch_stock'  => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_dispatch_sstock' => ['required', 'numeric', 'between:0.99999,9999999.99999'],
                'checked'            => ['nullable', 'string', 'max:1'],
                'must_be_sync'       => ['required'],
                'sync_at'            => ['nullable'],
                'created_by'         => ['nullable'],
                'updated_by'         => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'warehouse_id'       => ['sometimes', 'required', 'integer', 'exists:warehouses,id'],
                'article_id'         => ['sometimes', 'required', 'integer', 'exists:articles,id'],
                'actual_stock'       => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'actual_sstock'      => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'commited_stock'     => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'commited_sstock'    => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_arrive_stock'    => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_arrive_sstock'   => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_dispatch_stock'  => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'to_dispatch_sstock' => ['sometimes', 'required', 'numeric', 'between:0.99999,9999999.99999'],
                'checked'            => ['nullable', 'string', 'max:1'],
                'must_be_sync'       => ['sometimes', 'required'],
                'sync_at'            => ['nullable'],
                'created_by'         => ['nullable'],
                'updated_by'         => ['required', 'integer', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->warehouseId) {
            $this->merge([ 'warehouse_id' => $this->warehouseId, ]);
        }
        if ($this->articleId) {
            $this->merge([ 'article_id' => $this->articleId, ]);
        }
        if ($this->actualStock) {
            $this->merge([ 'actual_stock' => $this->actualStock, ]);
        }
        if ($this->actualSstock) {
            $this->merge([ 'actual_sstock' => $this->actualSstock, ]);
        }
        if ($this->commitedStock) {
            $this->merge([ 'commited_stock' => $this->commitedStock, ]);
        }
        if ($this->commitedSstock) {
            $this->merge([ 'commited_sstock' => $this->commitedSstock, ]);
        }
        if ($this->toArriveStock) {
            $this->merge([ 'to_arrive_stock' => $this->toArriveStock, ]);
        }
        if ($this->toArriveSstock) {
            $this->merge([ 'to_arrive_sstock' => $this->toArriveSstock, ]);
        }
        if ($this->toDispatchStock) {
            $this->merge([ 'to_dispatch_stock' => $this->toDispatchStock, ]);
        }
        if ($this->toDispatchSstock) {
            $this->merge([ 'to_dispatch_sstock' => $this->toDispatchSstock, ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        } else {
            $this->merge([ 'must_be_sync' => false, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }

}
