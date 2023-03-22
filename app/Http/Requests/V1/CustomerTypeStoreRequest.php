<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class CustomerTypeStoreRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:6', 'unique:customer_types,code'],
            'description' => ['required', 'string', 'max:100', 'unique:customer_types,description'],
            'price_list_id' => ['required', 'integer', 'exists:price_lists,id'],
            'must_be_sync' => ['required'],
            'sync_at' => ['nullable'],
            'created_by' => ['nullable'],
            'updated_by' => ['nullable'],
        ];
    }
}
