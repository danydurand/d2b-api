<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryStoreRequest extends FormRequest
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
            'code'         => ['required', 'string', 'max:6', 'unique:categories,code'],
            'description'  => ['required', 'string', 'max:100', 'unique:categories,description'],
            'must_be_sync' => ['required'],
            'sync_at'      => ['nullable'],
            'created_by'   => ['required', 'integer', 'exists:users,id'],
            'updated_by'   => ['nullable'],
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'created_by.required' => 'createdBy field is required',
    //         'created_by.integer' => 'createdBy field must be an integer',
    //         'created_by.exists' => 'createdBy field must be an integer corresponding to the user_id',
    //     ];
    // }

    protected function prepareForValidation()
    {
        if ($this->code) {
            $this->merge([ 'code' => Str::Upper($this->code), ]);
        }
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
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
