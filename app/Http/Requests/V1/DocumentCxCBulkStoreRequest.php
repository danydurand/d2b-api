<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DocumentCxCBulkStoreRequest extends FormRequest
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
            '*.documentTypeId'  => ['required', 'integer', 'exists:document_types,id'],
            '*.documentNumber'  => ['required', 'integer'],
            '*.nullified'       => ['required'],
            '*.controlNumber'   => ['required', 'integer'],
            '*.customerId'      => ['required', 'integer', 'exists:customers,id'],
            '*.sellerId'        => ['required', 'integer', 'exists:sellers,id'],
            '*.branchId'        => ['required', 'integer', 'exists:branches,id'],
            '*.isTaxPayer'      => ['required'],
            '*.documentDate'    => ['required'],
            '*.dueDate'         => ['required'],
            '*.taxType'         => ['required', 'string', 'max:1'],
            '*.exchangeRate'    => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.currencyId'      => ['required', 'integer', 'exists:currencies,id'],
            '*.taxAmount'       => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.grossAmount'     => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.discounts'       => ['nullable', 'string', 'max:15'],
            '*.discountAmount'  => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.surcharge'       => ['nullable', 'string', 'max:15'],
            '*.surchargeAmount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.otherAmount'     => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.netAmount'       => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.balance'         => ['required', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.liqourTaxAmount' => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.comments'        => ['nullable', 'string'],
            '*.field1'          => ['nullable', 'string', 'max:60'],
            '*.field2'          => ['nullable', 'string', 'max:60'],
            '*.field3'          => ['nullable', 'string', 'max:60'],
            '*.field4'          => ['nullable', 'string', 'max:60'],
            '*.field5'          => ['nullable', 'string', 'max:60'],
            '*.field6'          => ['nullable', 'string', 'max:60'],
            '*.field7'          => ['nullable', 'string', 'max:60'],
            '*.field8'          => ['nullable', 'string', 'max:60'],
            '*.other1'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.other2'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.other3'          => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.aux01'           => ['nullable', 'numeric', 'between:-9999999999999.99999,9999999999999.99999'],
            '*.aux02'           => ['nullable', 'string', 'max:30'],
            '*.recordDate'      => ['required'],
            '*.mustBeSync'      => ['required'],
            '*.syncAt'          => ['nullable'],
            '*.createdBy'       => ['required', 'integer', 'exists:users,id'],
            '*.updatedBy'       => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['document_type_id']  = $obj['documentTypeId'] ?? null;
            $obj['document_number']   = $obj['documentNumber'] ?? null;
            $obj['nullified']         = $obj['nullified'] ?? null;
            $obj['control_number']    = $obj['controlNumber'] ?? null;
            $obj['customer_id']       = $obj['customerId'] ?? null;
            $obj['seller_id']         = $obj['sellerId'] ?? null;
            $obj['branch_id']         = $obj['branchId'] ?? null;
            $obj['is_tax_payer']      = $obj['isTaxPayer'] ?? null;
            $obj['document_date']     = $obj['documentDate'] ?? null;
            $obj['due_date']          = $obj['dueDate'] ?? null;
            $obj['tax_type']          = $obj['taxType'] ?? null;
            $obj['exchange_rate']     = $obj['exchangeRate'] ?? null;
            $obj['currency_id']       = $obj['currencyId'] ?? null;
            $obj['tax_amount']        = $obj['taxAmount'] ?? null;
            $obj['gross_amount']      = $obj['grossAmount'] ?? null;
            $obj['discounts']         = $obj['discounts'] ?? null;
            $obj['discount_amount']   = $obj['discountAmount'] ?? null;
            $obj['surcharge']         = $obj['surcharge'] ?? null;
            $obj['surcharge_amount']  = $obj['surchargeAmount'] ?? null;
            $obj['other_amount']      = $obj['otherAmount'] ?? null;
            $obj['net_amount']        = $obj['netAmount'] ?? null;
            $obj['balance']           = $obj['balance'] ?? null;
            $obj['liqour_tax_amount'] = $obj['liqourTaxAmount'] ?? null;
            $obj['comments']          = $obj['comments'] ?? null;
            $obj['field1']            = $obj['field1'] ?? null;
            $obj['field2']            = $obj['field2'] ?? null;
            $obj['field3']            = $obj['field3'] ?? null;
            $obj['field4']            = $obj['field4'] ?? null;
            $obj['field5']            = $obj['field5'] ?? null;
            $obj['field6']            = $obj['field6'] ?? null;
            $obj['field7']            = $obj['field7'] ?? null;
            $obj['field8']            = $obj['field8'] ?? null;
            $obj['other1']            = $obj['other1'] ?? null;
            $obj['other2']            = $obj['other2'] ?? null;
            $obj['other3']            = $obj['other3'] ?? null;
            $obj['aux01']             = $obj['aux01'] ?? null;
            $obj['aux02']             = $obj['aux02'] ?? null;
            $obj['record_date']       = $obj['recordDate'] ?? null;

            $obj['must_be_sync']      = $obj['mustBeSync'] ?? null;
            $obj['sync_at']           = $obj['syncAt'] ?? null;
            $obj['created_by']        = $obj['createdBy'] ?? null;
            $obj['updated_by']        = $obj['createdBy'] ?? null;
            $obj['created_at']        = Carbon::now();
            $obj['updated_at']        = Carbon::now();

            $data[] = $obj;
        }

        $this->merge($data);
    }

}
