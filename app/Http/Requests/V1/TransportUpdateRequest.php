<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TransportUpdateRequest extends FormRequest
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
                'code'         => ['required', 'string', 'max:6', Rule::unique('transports')->ignore($this->id)],
                'name'         => ['required', 'string', 'max:100', Rule::unique('transports')->ignore($this->id)],
                'must_be_sync' => ['required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'code'         => ['sometimes', 'required', 'string', 'max:6', Rule::unique('transports')->ignore($this->id)],
                'name'         => ['sometimes', 'required', 'string', 'max:100', Rule::unique('transports')->ignore($this->id)],
                'must_be_sync' => ['sometimes', 'required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];

        }
    }

    protected function prepareForValidation()
    {
        if ($this->code) {
            $this->merge([ 'code' => Str::Upper($this->code), ]);
        }
        if (strlen($this->name)) {
            $this->merge([ 'name' => Str::upper($this->name), ]);
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
