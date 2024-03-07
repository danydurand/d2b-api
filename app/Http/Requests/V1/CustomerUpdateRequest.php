<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
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
        info('Method: '.$method);
        $id     = Route::current()->parameter('customer')->id;

        if ($method == 'PUT') {
            info('Putting');
            return [
                'code'            => ['required', 'string', 'max:6', Rule::unique('customers')->ignore($id) ],
                'fiscalNumber'    => ['required', 'string', 'max:30'],
                'businessName'    => ['required', 'string', 'max:100'],
                'customerTypeId'  => ['required', 'integer', 'exists:customer_types,id'],
                'sellerId'        => ['required', 'integer', 'exists:sellers,id'],
                'fiscalAddress'   => ['required', 'string', 'max:250'],
                'dispatchAddress' => ['required', 'string', 'max:250'],
                'phones'          => ['required', 'string', 'max:60'],
                'contactName'     => ['required', 'string', 'max:60'],
            ];
        } else {
            info('Patching');
            return [
                'code'            => ['sometimes', 'required', 'string', 'max:6', Rule::unique('customers')->ignore($id) ],
                'fiscalNumber'    => ['sometimes', 'required', 'string', 'max:30'],
                'businessName'    => ['sometimes', 'required', 'string', 'max:100'],
                'customerTypeId'  => ['sometimes', 'required', 'integer', 'exists:customer_types,id'],
                'sellerId'        => ['sometimes', 'required', 'integer', 'exists:sellers,id'],
                'fiscalAddress'   => ['sometimes', 'required', 'string', 'max:250'],
                'dispatchAddress' => ['sometimes', 'required', 'string', 'max:250'],
                'phones'          => ['sometimes', 'required', 'string', 'max:60'],
                'contactName'     => ['sometimes', 'required', 'string', 'max:60'],
            ];
        }
    }

    protected function prepareForValidation()
    {

        if ($this->code) {
            $this->merge(['code' => Str::upper($this->code)]);
        }
        if ($this->fiscalNumber) {
            $this->merge(['fiscal_number' => Str::upper($this->fiscalNumber)]);
        }
        if ($this->businessName) {
            $this->merge(['business_name' => Str::upper($this->businessName)]);
        }
        if ($this->customerTypeId) {
            $this->merge(['customer_type_id' => $this->customerTypeId]);
        }
        if ($this->sellerId) {
            $this->merge(['seller_id' => $this->sellerId]);
        }
        if ($this->fiscalAddress) {
            $this->merge(['fiscal_address' => Str::upper($this->fiscalAddress)]);
        }
        if ($this->dispatchAddress) {
            $this->merge(['dispatch_address' => Str::upper($this->dispatchAddress)]);
        }
        if ($this->contactName) {
            $this->merge(['contact_name' => Str::upper($this->contactName)]);
        }
        $this->merge([
            'must_be_sync' => false,
            'sync_at'      => Carbon::now()->toDateTimeString(),
            'updated_by'   => 1,
            'updated_at'   => Carbon::now()->toDateTimeString(),
        ]);

    }

}
