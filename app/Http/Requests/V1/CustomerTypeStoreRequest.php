<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'code'          => ['required', 'string', 'max:6', 'unique:customer_types,code'],
            'description'   => ['required', 'string', 'max:100', 'unique:customer_types,description'],
            'price_list_id' => ['required', 'integer', 'exists:price_lists,id'],
            'must_be_sync'  => ['required'],
            'sync_at'       => ['nullable'],
            'created_by'    => ['required', 'exists:users,id'],
            'updated_by'    => ['nullable'],
        ];
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
                'created_by' => $this->createdBy,
                'updated_by' => $this->createdBy,
            ]);
        }
    }

}
