<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('brand')->id;

        if ($method == 'PUT') {
            return [
                'code'        => ['required', 'string', 'max:6'],
                'description' => ['required', 'string', 'max:100', Rule::unique('brands')->ignore($id)],
                'batch'       => ['required', 'integer'],
            ];
        } else {
            return [
                'code'        => ['sometimes', 'required', 'string', 'max:6'],
                'description' => ['sometimes', 'required', 'string', 'max:100', Rule::unique('brands')->ignore($id)],
                'batch'       => ['required', 'integer'],
            ];

        }
    }

    protected function prepareForValidation()
    {
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        $this->merge([
            'must_be_sync' => false,
            'sync_at'      => Carbon::now()->toDateTimeString(),
            'updated_by'   => 1,
            'updated_at'   => Carbon::now()->toDateTimeString(),
        ]);
    }

}
