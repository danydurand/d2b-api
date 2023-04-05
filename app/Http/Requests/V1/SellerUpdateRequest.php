<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SellerUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('seller')->id;

        if ($method == 'PUT') {
            return [
                'name'               => ['required', 'string', 'max:100', Rule::unique('sellers')->ignore($id)],
                'sales_commission'   => ['required', 'numeric', 'between:0,999.99'],
                'collect_commission' => ['required', 'numeric', 'between:0,999.99'],
                'login'              => ['required', 'string', 'max:8', Rule::unique('sellers')->ignore($id)],
                'password'           => ['nullable', 'max:255'],
                'last_login_at'      => ['nullable'],
                'must_be_sync'       => ['required'],
                'sync_at'            => ['nullable'],
                'created_by'         => ['nullable'],
                'updated_by'         => ['required', 'exists:users,id'],
            ];
        } else {
            return [
                'name'               => ['sometimes', 'required', 'string', 'max:100', Rule::unique('sellers')->ignore($id)],
                'sales_commission'   => ['sometimes', 'required', 'numeric', 'between:0,999.99'],
                'collect_commission' => ['sometimes', 'required', 'numeric', 'between:0,999.99'],
                'login'              => ['sometimes', 'required', 'string', 'max:8', Rule::unique('sellers')->ignore($id)],
                'password'           => ['sometimes', 'nullable', 'max:255'],
                'last_login_at'      => ['sometimes', 'nullable'],
                'must_be_sync'       => ['sometimes', 'required'],
                'sync_at'            => ['nullable'],
                'created_by'         => ['nullable'],
                'updated_by'         => ['required', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        // info("In: ".print_r($this->all(), true));
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
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
        // info("Out: ".print_r($this->all(), true));
    }

}
