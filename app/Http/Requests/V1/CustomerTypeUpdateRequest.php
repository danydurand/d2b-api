<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomerTypeUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('customer_type')->id;

        if ($method == 'PUT') {
            return [
                'code'          => ['required', 'string', 'max:6', Rule::unique('customer_types')->ignore($id)],
                'description'   => ['required', 'string', 'max:100', Rule::unique('customer_types')->ignore($id)],
                'price_list_id' => ['required', 'integer', 'exists:price_lists,id'],
                'must_be_sync'  => ['required'],
                'sync_at'       => ['nullable'],
                'created_by'    => ['nullable'],
                'updated_by'    => ['required', 'exists:users,id'],
            ];
        } else {
            return [
                'code'          => ['sometimes', 'required', 'string', 'max:6', Rule::unique('customer_types')->ignore($id)],
                'description'   => ['sometimes', 'required', 'string', 'max:100', Rule::unique('customer_types')->ignore($id)],
                'price_list_id' => ['sometimes', 'required', 'integer', 'exists:price_lists,id'],
                'must_be_sync'  => ['sometimes', 'required'],
                'sync_at'       => ['nullable'],
                'created_by'    => ['nullable'],
                'updated_by'    => ['required', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->code) {
            $this->merge([
                'code' => Str::Upper($this->code),
            ]);
        }
        if ($this->description) {
            $this->merge([
                'description' => Str::Upper($this->description),
            ]);
        }
        if ($this->listPriceId) {
            $this->merge([
                'list_price_id' => $this->listPriceId,
            ]);
        }
        if ($this->mustBeSync) {
            $this->merge([
                'must_be_sync' => $this->mustBeSync,
            ]);
        }
        if ($this->syncAt) {
            $this->merge([
                'sync_at' => $this->syncAt,
            ]);
        }
        if ($this->updatedBy) {
            $this->merge([
                'updated_by' => $this->updatedBy,
            ]);
        }
    }

}
