<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PriceListStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50', 'unique:price_lists,name'],
            'must_be_sync' => ['required'],
            'sync_at' => ['nullable'],
            'created_by' => ['nullable'],
            'updated_by' => ['nullable'],
        ];
    }
}
