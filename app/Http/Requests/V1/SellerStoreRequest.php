<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', 'unique:sellers,name'],
            'sales_commission' => ['required', 'numeric', 'between:0,999.99'],
            'collect_commission' => ['required', 'numeric', 'between:0,999.99'],
            'login' => ['required', 'string', 'max:8', 'unique:sellers,login'],
            'password' => ['nullable', 'max:255'],
            'last_login_at' => ['nullable'],
            'must_be_sync' => ['required'],
            'sync_at' => ['nullable'],
            'created_by' => ['required'],
            'updated_by' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        info("In: ".print_r($this->all(), true));
        if ($this->name) {
            $this->merge([ 'name' => Str::upper($this->name), ]);
        }
        if ($this->salesCommission) {
            $this->merge([ 'sales_commission' => $this->salesCommission, ]);
        }
        if ($this->collectCommission) {
            $this->merge([ 'collect_commission' => $this->collectCommission, ]);
        }
        if ($this->login) {
            $this->merge([ 'login' => Str::lower($this->login), ]);
        }
        if ($this->password) {
            $this->merge([ 'password' => Hash::make($this->password), ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        } else {
            $this->merge([ 'must_be_sync' => false, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->createdBy) {
            $this->merge([
                'created_by' => 1,
                'updated_by' => $this->createdBy,
            ]);
        }
        info("Out: ".print_r($this->all(), true));
    }

}
