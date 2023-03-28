<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PriceListStoreRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:50', 'unique:price_lists,name'],
            'must_be_sync' => ['required'],
            'sync_at'      => ['nullable'],
            'created_by'   => ['required', 'integer', 'exists:users,id'],
            'updated_by'   => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        info("Arriving: ".print_r($this->all(), true));

        if ($this->name) {
            info("Name: {$this->name}");
            $this->merge([
                'name' => Str::Upper($this->name),
            ]);
            info("Name: {$this->name}");
        }
        if (strlen($this->mustBeSync)) {
            info("Must be sync: {$this->mustBeSync}");
            $this->merge([
                'must_be_sync' => $this->mustBeSync,
            ]);
        }
        if ($this->syncAt) {
            info("Sync at: {$this->syncAt}");
            $this->merge([
                'sync_at' => $this->syncAt,
            ]);
        }
        if ($this->createdBy) {
            $this->merge([
                'created_by' => $this->createdBy,
                'updated_by' => $this->createdBy,
            ]);
        }
        // if ($this->updatedBy) {
        //     $this->merge([
        //         'updated_by' => $this->updatedBy,
        //     ]);
        // }
        info("Leaving: ".print_r($this->all(), true));
    }

}
