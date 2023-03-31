<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SubLineStoreRequest extends FormRequest
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
            'line_id'      => ['required', 'integer', 'exists:lines,id'],
            'description'  => ['required', 'string', 'max:100', 'unique:sub_lines,description'],
            'must_be_sync' => ['required'],
            'sync_at'      => ['nullable'],
            'created_by'   => ['nullable'],
            'updated_by'   => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->lineId) {
            $this->merge([ 'line_id' => $this->lineId, ]);
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
