<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CustomerStoreRequest extends FormRequest
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
            'code'             => ['required', 'string', 'max:6', 'unique:customers,code'],
            'fiscalNumber'     => ['required', 'string', 'max:30'],
            'businessName'     => ['required', 'string', 'max:100'],
            'customerTypeId'   => ['required', 'integer', 'exists:customer_types,id'],
            'sellerId'         => ['required', 'integer', 'exists:sellers,id'],
            'fiscalAddress'    => ['nullable', 'string', 'max:250'],
            'dispatchAaddress' => ['nullable', 'string', 'max:250'],
            'phones'           => ['nullable', 'string', 'max:60'],
            'contactName'      => ['nullable', 'string', 'max:60'],
            'syncAt'           => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $obj  = $this->toArray();

        $obj['code']             = $obj['code'] ? Str::upper($obj['code']) : null;
        $obj['fiscal_number']    = $obj['fiscalNumber'] ? Str::upper($obj['fiscalNumber']) : null;
        $obj['business_name']    = $obj['businessName'] ? Str::upper($obj['businessName']) : null;
        $obj['customer_type_id'] = $obj['customerTypeId'] ?? null;
        $obj['seller_id']        = $obj['sellerId'] ?? null;
        $obj['fiscal_address']   = $obj['fiscalAddress'] ? Str::upper($obj['fiscalAddress']) : null;
        $obj['dispatch_address'] = $obj['dispatchAddress'] ? Str::upper($obj['dispatchAddress']) : null;
        $obj['contact_name']     = $obj['contactName'] ? Str::upper($obj['contactName']) : null;

        $obj['must_be_sync']     = $obj['mustBeSync'] ?? false;
        $obj['sync_at']          = $obj['syncAt'] ?? null;
        $obj['created_by']       = $obj['createdBy'] ?? 1;
        $obj['updated_by']       = $obj['createdBy'] ?? 1;
        $obj['created_at']       = Carbon::now()->toDateTimeString();
        $obj['updated_at']       = Carbon::now()->toDateTimeString();

        $this->merge($obj);

    }

}
