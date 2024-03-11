<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BrandBulkUpdateRequest extends FormRequest
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
            '*.id'           => ['required', 'integer'],
            '*.description'  => ['required', 'string', 'max:100', 'unique:brands,description'],
            '*.batch'        => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['description']  = $obj['description'] ? Str::upper($obj['description']) : null;
            $obj['must_be_sync'] = false;
            $obj['sync_at']      = Carbon::now()->toDateTimeString();
            $obj['updated_by']   = 1;
            $obj['updated_at']   = Carbon::now()->toDateTimeString();

            $data[] = $obj;
        }

        $this->merge($data);
    }

}
