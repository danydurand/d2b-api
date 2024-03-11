<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
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
            'batch'        => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $obj  = $this->toArray();

        $obj['code']         = $obj['code'] ?? null;
        $obj['description']  = $obj['description'] ? Str::upper($obj['description']) : null;
        $obj['must_be_sync'] = false;
        $obj['sync_at']      = Carbon::now()->toDateTimeString();
        $obj['created_by']   = 1;
        $obj['updated_by']   = 1;
        $obj['created_at']   = Carbon::now()->toDateTimeString();
        $obj['updated_at']   = Carbon::now()->toDateTimeString();

        $this->merge($obj);

    }
}
