<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('customer')->id;

        if ($method == 'PUT') {
            return [
                'code'             => ['required', 'string', 'max:6', Rule::unique('customers')->ignore($id) ],
                'fiscal_number'    => ['required', 'string', 'max:30'],
                'business_name'    => ['required', 'string', 'max:100'],
                'customer_type_id' => ['required', 'integer', 'exists:customer_types,id'],
                'seller_id'        => ['required', 'integer', 'exists:sellers,id'],
                'fiscal_address'   => ['required', 'string', 'max:250'],
                'dispatch_address' => ['required', 'string', 'max:250'],
                'phones'           => ['required', 'string', 'max:60'],
                'contact_name'     => ['required', 'string', 'max:60'],
                'must_be_sync'     => ['required'],
                'sync_at'          => ['nullable'],
                'created_by'       => ['nullable'],
                'updated_by'       => ['required', 'exists:users,id'],
            ];
        } else {
            return [
                'code'             => ['sometimes', 'required', 'string', 'max:6', Rule::unique('customers')->ignore($id) ],
                'fiscal_number'    => ['sometimes', 'required', 'string', 'max:30'],
                'business_name'    => ['sometimes', 'required', 'string', 'max:100'],
                'customer_type_id' => ['sometimes', 'required', 'integer', 'exists:customer_types,id'],
                'seller_id'        => ['sometimes', 'required', 'integer', 'exists:sellers,id'],
                'fiscal_address'   => ['sometimes', 'required', 'string', 'max:250'],
                'dispatch_address' => ['sometimes', 'required', 'string', 'max:250'],
                'phones'           => ['sometimes', 'required', 'string', 'max:60'],
                'contact_name'     => ['sometimes', 'required', 'string', 'max:60'],
                'must_be_sync'     => ['sometimes', 'required'],
                'sync_at'          => ['nullable'],
                'created_by'       => ['nullable'],
                'updated_by'       => ['required', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge([ 'name' => Str::Upper($this->name), ]);
        }
        if (strlen($this->fiscalNumber)) {
            $this->merge([ 'fiscal_number' => Str::upper($this->fiscalNumber), ]);
        }
        if (strlen($this->businessName)) {
            $this->merge([ 'business_name' => Str::upper($this->businessName), ]);
        }
        if (strlen($this->customerTypeId)) {
            $this->merge([ 'customer_type_id' => $this->customerTypeId, ]);
        }
        if (strlen($this->sellerId)) {
            $this->merge([ 'seller_id' => $this->sellerId, ]);
        }
        if (strlen($this->fiscalAddress)) {
            $this->merge([ 'fiscal_address' => Str::Upper($this->fiscalAddress), ]);
        }
        if (strlen($this->dispatchAddress)) {
            $this->merge([ 'dispatch_address' => Str::Upper($this->dispatchAddress), ]);
        }
        if (strlen($this->contactName)) {
            $this->merge([ 'contact_name' => Str::Upper($this->contactName), ]);
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
