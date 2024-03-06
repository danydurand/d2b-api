<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleStoreRequest extends FormRequest
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
            'code'           => ['required', 'string', 'max:30', 'unique:articles,code'],
            'description'    => ['required', 'string', 'max:100', 'unique:articles,description'],
            'businessId'     => ['nullable', 'integer', 'exists:businesses,id'],
            'brandId'        => ['required', 'integer', 'exists:brands,id'],
            'subBrandId'     => ['required', 'integer', 'exists:sub_brands,id'],
            'categoryId'     => ['required', 'integer', 'exists:categories,id'],
            'lineId'         => ['required', 'integer', 'exists:lines,id'],
            'subLineId'      => ['required', 'integer', 'exists:sub_lines,id'],
            'colourId'       => ['required', 'integer', 'exists:colours,id'],
            'saleUnitId'     => ['required', 'integer', 'exists:sale_units,id'],
            'ssaleUnitId'    => ['required', 'integer', 'exists:sale_units,id'],
            'comments'       => ['nullable', 'string'],
            'picture'        => ['nullable', 'string', 'max:100'],
            'weight'         => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'feet'           => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'salePrice1'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'salePrice2'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'salePrice3'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'salePrice4'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'salePrice5'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'lastDatePrice1' => ['nullable'],
            'lastDatePrice2' => ['nullable'],
            'lastDatePrice3' => ['nullable'],
            'lastDatePrice4' => ['nullable'],
            'lastDatePrice5' => ['nullable'],
            'realStock'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'commitedStock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'srealStock'     => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'scommitedStock' => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
            'mustBeSync'     => ['nullable', 'boolean'],
            'syncAt'         => ['nullable'],
            'createdBy'      => ['required','integer', 'exists:users,id'],
            'updatedBy'      => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        info("Getting into Brand validation...");

        $obj = $this->toArray();

        $obj['code']              = $obj['code'] ?? null;
        $obj['description']       = $obj['description'] ?? null;
        $obj['business_id']       = $obj['businessId'] ?? null;
        $obj['brand_id']          = $obj['brandId'] ? $obj['brandId'] : null;
        $obj['sub_brand_id']      = $obj['subBrandId'] ?? null;
        $obj['category_id']       = $obj['categoryId'] ?? null;
        $obj['line_id']           = $obj['lineId'] ?? null;
        $obj['sub_line_id']       = $obj['subLineId'] ?? null;
        $obj['colour_id']         = $obj['colourId'] ?? null;
        $obj['sale_unit_id']      = $obj['saleUnitId'] ?? null;
        $obj['ssale_unit_id']     = $obj['ssaleUnitId'] ?? null;
        $obj['comments']          = $obj['comments'] ?? null;
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

        $obj['must_be_sync']      = $obj['mustBeSync'] ?? null;
        $obj['sync_at']           = $obj['syncAt'] ?? null;
        $obj['created_by']        = $obj['createdBy'] ?? null;
        $obj['updated_by']        = $obj['createdBy'] ?? null;
        $obj['created_at']        = Carbon::now()->toDateTimeString();
        $obj['updated_at']        = Carbon::now()->toDateTimeString();

        $this->merge($obj);

    }

    // protected function prepareForValidation()
    // {
    //     info("Getting into Brand validation...");
    //     if (strlen($this->code)) {
    //         $this->merge([ 'code' => Str::upper($this->code), ]);
    //     }
    //     if (strlen($this->description)) {
    //         $this->merge([ 'description' => Str::upper($this->description), ]);
    //     }
    //     info('Business Id: '.$this->businessId);
    //     if ($this->businessId) {
    //         info('Here I am');
    //         $this->merge([ 'business_id' => $this->businessId, ]);
    //     }
    //     if ($this->brandId) {
    //         $this->merge([ 'brand_id' => $this->brandId, ]);
    //     }
    //     if ($this->subBrandId) {
    //         $this->merge([ 'sub_brand_id' => $this->subBrandId, ]);
    //     }
    //     if ($this->categoryId) {
    //         $this->merge([ 'category_id' => $this->categoryId, ]);
    //     }
    //     if ($this->lineId) {
    //         $this->merge([ 'line_id' => $this->lineId, ]);
    //     }
    //     if ($this->subLineId) {
    //         $this->merge([ 'sub_line_id' => $this->subLineId, ]);
    //     }
    //     if ($this->colourId) {
    //         $this->merge([ 'colour_id' => $this->colourId, ]);
    //     }
    //     if ($this->originId) {
    //         $this->merge([ 'origin_id' => $this->originId, ]);
    //     }
    //     if ($this->articleTypeId) {
    //         $this->merge([ 'article_type_id' => $this->articleTypeId, ]);
    //     }
    //     if ($this->providerId) {
    //         $this->merge([ 'provider_id' => $this->providerId, ]);
    //     }
    //     if ($this->saleUnitId) {
    //         $this->merge([ 'sale_unit_id' => $this->saleUnitId, ]);
    //     }
    //     if ($this->ssaleUnitId) {
    //         $this->merge([ 'ssale_unit_id' => $this->ssaleUnitId, ]);
    //     }
    //     if ($this->salePrice1) {
    //         $this->merge([ 'sale_price1' => $this->salePrice1, ]);
    //     }
    //     if ($this->salePrice2) {
    //         $this->merge([ 'sale_price2' => $this->salePrice2, ]);
    //     }
    //     if ($this->salePrice3) {
    //         $this->merge([ 'sale_price3' => $this->salePrice3, ]);
    //     }
    //     if ($this->salePrice4) {
    //         $this->merge([ 'sale_price4' => $this->salePrice4, ]);
    //     }
    //     if ($this->salePrice5) {
    //         $this->merge([ 'sale_price5' => $this->salePrice5, ]);
    //     }
    //     if ($this->lastDatePrice1) {
    //         $this->merge([ 'last_date_price1' => $this->lastDatePrice1, ]);
    //     }
    //     if ($this->lastDatePrice2) {
    //         $this->merge([ 'last_date_price2' => $this->lastDatePrice2, ]);
    //     }
    //     if ($this->lastDatePrice3) {
    //         $this->merge([ 'last_date_price3' => $this->lastDatePrice3, ]);
    //     }
    //     if ($this->lastDatePrice4) {
    //         $this->merge([ 'last_date_price4' => $this->lastDatePrice4, ]);
    //     }
    //     if ($this->lastDatePrice5) {
    //         $this->merge([ 'last_date_price5' => $this->lastDatePrice5, ]);
    //     }
    //     if ($this->realStock) {
    //         $this->merge([ 'real_stock' => $this->realStock, ]);
    //     }
    //     if ($this->commitedStock) {
    //         $this->merge([ 'commited_stock' => $this->commitedStock, ]);
    //     }
    //     if ($this->commingStock) {
    //         $this->merge([ 'comming_stock' => $this->commingStock, ]);
    //     }
    //     if ($this->dispatchStock) {
    //         $this->merge([ 'dispatch_stock' => $this->dispatchStock, ]);
    //     }
    //     info("mustBeSync: $this->mustBeSync");
    //     if (strlen($this->mustBeSync)) {
    //         $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
    //     }
    //     if ($this->syncAt) {
    //         $this->merge([ 'sync_at' => $this->syncAt, ]);
    //     }
    //     if ($this->createdBy) {
    //         $this->merge([
    //             'created_by' => $this->createdBy,
    //             'updated_by' => $this->createdBy,
    //         ]);
    //     }
    //     info("Leaving...");
    // }

}
