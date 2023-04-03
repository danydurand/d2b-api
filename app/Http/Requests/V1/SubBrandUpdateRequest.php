<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubBrandUpdateRequest extends FormRequest
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
                'brand_id'     => ['required', 'integer', 'exists:brands,id'],
                'description'  => ['required', 'string', 'max:100', Rule::unique('sub_brands')->ignore($this->id)],
                'must_be_sync' => ['required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'brand_id'     => ['sometimes', 'required', 'integer', 'exists:brands,id'],
                // 'description'  => ['sometimes', 'required', 'string', 'max:100', Rule::unique('sub_brands')->ignore($this->id)],
                'description'  => ['sometimes', 'required', 'string', 'max:100'],
                'must_be_sync' => ['sometimes', 'required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        }
    }
    protected function prepareForValidation()
    {
        if ($this->brandId) {
            $this->merge([ 'brand_id' => $this->brandId, ]);
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
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }


}
