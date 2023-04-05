<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PriceListUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('priceList')->id;


        if ($method == 'PUT') {
            return [
                'name'         => ['required', 'string', 'max:50', Rule::unique('price_lists')->ignore($id)],
                'must_be_sync' => ['nullable', 'boolean'],
                'sync_at'      => ['nullable', 'datetime'],
                'updated_by'   => ['required', 'exists:users,id'],
            ];
        } else {
            return [
                'name'         => ['sometimes', 'required', 'string', 'max:50', Rule::unique('price_lists')->ignore($id)],
                'must_be_sync' => ['nullable', 'boolean'],
                'sync_at'      => ['nullable', 'datetime'],
                'updated_by'   => ['required', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge([ 'name' => Str::Upper($this->name), ]);
        }
        if ($this->mustBeSync) {
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
