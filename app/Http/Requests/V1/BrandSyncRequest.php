<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BrandSyncRequest extends FormRequest
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
            '*.id' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['must_be_sync'] = false;
            $obj['sync_at']      = Carbon::now()->toDateTimeString();
            $data[] = $obj;
        }

        $this->merge($data);
    }

}
