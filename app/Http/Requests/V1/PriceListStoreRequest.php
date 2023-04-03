<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'name'         => ['required', 'string', 'max:50', 'unique:price_lists,name'],
            'must_be_sync' => ['required'],
            'sync_at'      => ['nullable'],
            'created_by'   => ['required', 'integer', 'exists:users,id'],
            'updated_by'   => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge([ 'name' => Str::Upper($this->name), ]);
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
