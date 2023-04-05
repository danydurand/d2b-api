<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubLineUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('subLine')->id;


        if ($method == 'PUT') {
            return [
                'line_id'      => ['required', 'integer', 'exists:lines,id'],
                'description'  => ['required', 'string', 'max:100', Rule::unique('sub_lines')->ignore($id)],
                'must_be_sync' => ['required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'line_id'      => ['sometimes', 'required', 'integer', 'exists:lines,id'],
                'description'  => ['sometimes', 'required', 'string', 'max:100', Rule::unique('sub_lines')->ignore($id)],
                'must_be_sync' => ['sometimes', 'required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        }
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
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }


}
