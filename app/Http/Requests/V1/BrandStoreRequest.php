<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BrandStoreRequest extends FormRequest
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
            'description'  => ['required', 'string', 'max:100', 'unique:brands,description'],
            'batch'        => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $obj  = $this->toArray();

        // info('Before: '.print_r($obj, true));

        $obj['description']  = $obj['description'] ? Str::upper($obj['description']) : null;
        $obj['must_be_sync'] = false;
        $obj['sync_at']      = Carbon::now()->toDateTimeString();
        $obj['created_by']   = 1;
        $obj['updated_by']   = 1;
        $obj['created_at']   = Carbon::now()->toDateTimeString();
        $obj['updated_at']   = Carbon::now()->toDateTimeString();

        // info('After: '.print_r($obj, true));

        $this->merge($obj);
    }

}
