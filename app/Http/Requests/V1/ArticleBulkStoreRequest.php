<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleBulkStoreRequest extends FormRequest
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
            '*.code'           => ['required', 'string', 'max:30', 'unique:articles,code'],
            '*.description'    => ['required', 'string', 'max:100', 'unique:articles,description'],
            '*.brandId'        => ['required', 'integer', 'exists:brands,id'],
            '*.subBrandId'     => ['required', 'integer', 'exists:sub_brands,id'],
            '*.categoryId'     => ['required', 'integer', 'exists:categories,id'],
            '*.lineId'         => ['required', 'integer', 'exists:lines,id'],
            '*.subLineId'      => ['required', 'integer', 'exists:sub_lines,id'],
            '*.colourId'       => ['required', 'integer', 'exists:colours,id'],
            '*.saleUnitId'     => ['required', 'integer', 'exists:sale_units,id'],
            '*.ssaleUnitId'    => ['required', 'integer', 'exists:sale_units,id'],
            '*.comments'       => ['nullable', 'string'],
            '*.picture'        => ['nullable', 'string', 'max:100'],
            '*.weight'         => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.feet'           => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.salePrice1'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.salePrice2'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.salePrice3'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.salePrice4'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.salePrice5'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.lastDatePrice1' => ['nullable'],
            '*.lastDatePrice2' => ['nullable'],
            '*.lastDatePrice3' => ['nullable'],
            '*.lastDatePrice4' => ['nullable'],
            '*.lastDatePrice5' => ['nullable'],
            '*.realStock'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.commitedStock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.srealStock'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.scommitedStock' => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            '*.mustBeSync'     => ['nullable', 'boolean'],
            '*.syncAt'         => ['nullable'],
            // '*.createdBy'      => ['required','integer', 'exists:users,id'],
            // '*.updatedBy'      => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['code']              = $obj['code'] ?? null;
            $obj['description']       = $obj['description'] ?? null;
            $obj['business_id']       = $obj['businessId'] ?? null;
            $obj['brand_id']          = $obj['brandId'] ?? null;
            $obj['sub_brand_id']      = $obj['subBrandId'] ?? null;
            $obj['category_id']       = $obj['categoryId'] ?? null;
            $obj['line_id']           = $obj['lineId'] ?? null;
            $obj['sub_line_id']       = $obj['subLineId'] ?? null;
            $obj['colour_id']         = $obj['colourId'] ?? null;
            $obj['sale_unit_id']      = $obj['saleUnitId'] ?? null;
            $obj['ssale_unit_id']     = $obj['ssaleUnitId'] ?? null;
            $obj['reference']         = $obj['reference'] ?? null;
            $obj['picture']           = $obj['picture'] ?? null;
            $obj['weight']            = $obj['weight'] ?? null;
            $obj['feet']              = $obj['feet'] ?? null;
            $obj['sale_price1']       = $obj['salePrice1'] ?? null;
            $obj['sale_price2']       = $obj['salePrice2'] ?? null;
            $obj['sale_price3']       = $obj['salePrice3'] ?? null;
            $obj['sale_price4']       = $obj['salePrice4'] ?? null;
            $obj['sale_price5']       = $obj['salePrice5'] ?? null;
            $obj['last_date_price1']  = $obj['lastDatePrice1'] ?? null;
            $obj['last_date_price2']  = $obj['lastDatePrice2'] ?? null;
            $obj['last_date_price3']  = $obj['lastDatePrice3'] ?? null;
            $obj['last_date_price4']  = $obj['lastDatePrice4'] ?? null;
            $obj['last_date_price5']  = $obj['lastDatePrice5'] ?? null;
            $obj['real_stock']        = $obj['realStock'] ?? null;
            $obj['commited_stock']    = $obj['commitedStock'] ?? null;
            $obj['sreal_stock']       = $obj['srealStock'] ?? null;
            $obj['scommited_stock']   = $obj['scommitedStock'] ?? null;

            $obj['must_be_sync']      = $obj['mustBeSync'] ?? false;
            $obj['sync_at']           = $obj['syncAt'] ?? null;
            $obj['created_by']        = $obj['createdBy'] ?? 1;
            $obj['updated_by']        = $obj['createdBy'] ?? 1;
            $obj['created_at']        = Carbon::now()->toDayDateTimeString();
            $obj['updated_at']        = Carbon::now()->toDayDateTimeString();

            $data[] = $obj;
        }

        $this->merge($data);
    }

}
