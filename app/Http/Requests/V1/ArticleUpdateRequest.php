<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
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
        $id     = Route::current()->parameter('article')->id;

        if ($method == 'PUT') {
            return [
                'code'             => ['required', 'string', 'max:30', Rule::unique('articles')->ignore($id)],
                'description'      => ['required', 'string', 'max:100', Rule::unique('articles')->ignore($id)],
                'business_id'      => ['required', 'integer', 'exists:businesses,id'],
                'brand_id'         => ['required', 'integer', 'exists:brands,id'],
                'sub_brand_id'     => ['required', 'integer', 'exists:sub_brands,id'],
                'category_id'      => ['required', 'integer', 'exists:categories,id'],
                'line_id'          => ['required', 'integer', 'exists:lines,id'],
                'sub_line_id'      => ['required', 'integer', 'exists:sub_lines,id'],
                'colour_id'        => ['required', 'integer', 'exists:colours,id'],
                'origin_id'        => ['required', 'integer', 'exists:origins,id'],
                'article_type_id'  => ['required', 'integer', 'exists:article_types,id'],
                'provider_id'      => ['required', 'integer', 'exists:providers,id'],
                'sale_unit_id'     => ['required', 'integer', 'exists:sale_units,id'],
                'ssale_unit_id'    => ['required', 'integer', 'exists:sale_units,id'],
                'reference'        => ['required', 'string', 'max:20'],
                'model'            => ['required', 'string', 'max:20'],
                'comments'         => ['nullable', 'string'],
                'compose'          => ['nullable'],
                'picture'          => ['nullable', 'string', 'max:100'],
                'field1'           => ['nullable', 'string', 'max:60'],
                'field2'           => ['nullable', 'string', 'max:60'],
                'field3'           => ['nullable', 'string', 'max:60'],
                'field4'           => ['nullable', 'string', 'max:60'],
                'field5'           => ['nullable', 'string', 'max:60'],
                'x_11'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'x_12'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'weight'           => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'feet'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price1'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price2'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price3'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price4'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price5'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'last_date_price1' => ['nullable'],
                'last_date_price2' => ['nullable'],
                'last_date_price3' => ['nullable'],
                'last_date_price4' => ['nullable'],
                'last_date_price5' => ['nullable'],
                'real_stock'       => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'commited_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'comming_stock'    => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'dispatch_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sreal_stock'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'scommited_stock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'scomming_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sdispatch_stock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin1'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin2'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin3'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin4'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin5'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'must_be_sync'     => ['nullable'],
                'sync_at'          => ['nullable'],
                'created_by'       => ['nullable'],
                'updated_by'       => ['required','integer', 'exists:users,id'],
            ];
        } else {
            return [
                'code'             => ['sometimes', 'required', 'string', 'max:30', Rule::unique('articles')->ignore($id)],
                'description'      => ['sometimes', 'required', 'string', 'max:100', Rule::unique('articles')->ignore($id)],
                'business_id'      => ['sometimes', 'required', 'integer', 'exists:businesses,id'],
                'brand_id'         => ['sometimes', 'required', 'integer', 'exists:brands,id'],
                'sub_brand_id'     => ['sometimes', 'required', 'integer', 'exists:sub_brands,id'],
                'category_id'      => ['sometimes', 'required', 'integer', 'exists:categories,id'],
                'line_id'          => ['sometimes', 'required', 'integer', 'exists:lines,id'],
                'sub_line_id'      => ['sometimes', 'required', 'integer', 'exists:sub_lines,id'],
                'colour_id'        => ['sometimes', 'required', 'integer', 'exists:colours,id'],
                'origin_id'        => ['sometimes', 'required', 'integer', 'exists:origins,id'],
                'article_type_id'  => ['sometimes', 'required', 'integer', 'exists:article_types,id'],
                'provider_id'      => ['sometimes', 'required', 'integer', 'exists:providers,id'],
                'sale_unit_id'     => ['sometimes', 'required', 'integer', 'exists:sale_units,id'],
                'ssale_unit_id'    => ['sometimes', 'required', 'integer', 'exists:sale_units,id'],
                'reference'        => ['sometimes', 'required', 'string', 'max:20'],
                'model'            => ['sometimes', 'required', 'string', 'max:20'],
                'comments'         => ['nullable', 'string'],
                'compose'          => ['nullable'],
                'picture'          => ['nullable', 'string', 'max:100'],
                'field1'           => ['nullable', 'string', 'max:60'],
                'field2'           => ['nullable', 'string', 'max:60'],
                'field3'           => ['nullable', 'string', 'max:60'],
                'field4'           => ['nullable', 'string', 'max:60'],
                'field5'           => ['nullable', 'string', 'max:60'],
                'x_11'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'x_12'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'weight'           => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'feet'             => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price1'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price2'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price3'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price4'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sale_price5'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'last_date_price1' => ['nullable'],
                'last_date_price2' => ['nullable'],
                'last_date_price3' => ['nullable'],
                'last_date_price4' => ['nullable'],
                'last_date_price5' => ['nullable'],
                'real_stock'       => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'commited_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'comming_stock'    => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'dispatch_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sreal_stock'      => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'scommited_stock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'scomming_stock'   => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'sdispatch_stock'  => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin1'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin2'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin3'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin4'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'margin5'          => ['nullable', 'numeric', 'between:0.01,9999999999999.99999'],
                'must_be_sync'     => ['nullable'],
                'sync_at'          => ['nullable'],
                'created_by'       => ['nullable'],
                'updated_by'       => ['required','integer', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (strlen($this->code)) {
            $this->merge([ 'code' => Str::upper($this->code), ]);
        }
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        if ($this->businessId) {
            $this->merge([ 'business_id' => $this->businessId, ]);
        }
        if ($this->brandId) {
            $this->merge([ 'brand_id' => $this->brandId, ]);
        }
        if ($this->subBrandId) {
            $this->merge([ 'sub_brand_id' => $this->subBrandId, ]);
        }
        if ($this->categoryId) {
            $this->merge([ 'category_id' => $this->categoryId, ]);
        }
        if ($this->lineId) {
            $this->merge([ 'line_id' => $this->lineId, ]);
        }
        if ($this->subLineId) {
            $this->merge([ 'sub_line_id' => $this->subLineId, ]);
        }
        if ($this->colourId) {
            $this->merge([ 'colour_id' => $this->colourId, ]);
        }
        if ($this->originId) {
            $this->merge([ 'origin_id' => $this->originId, ]);
        }
        if ($this->articleTypeId) {
            $this->merge([ 'article_type_id' => $this->articleTypeId, ]);
        }
        if ($this->providerId) {
            $this->merge([ 'provider_id' => $this->providerId, ]);
        }
        if ($this->saleUnitId) {
            $this->merge([ 'sale_unit_id' => $this->saleUnitId, ]);
        }
        if ($this->ssaleUnitId) {
            $this->merge([ 'ssale_unit_id' => $this->ssaleUnitId, ]);
        }
        if ($this->salePrice1) {
            $this->merge([ 'sale_price1' => $this->salePrice1, ]);
        }
        if ($this->salePrice2) {
            $this->merge([ 'sale_price2' => $this->salePrice2, ]);
        }
        if ($this->salePrice3) {
            $this->merge([ 'sale_price3' => $this->salePrice3, ]);
        }
        if ($this->salePrice4) {
            $this->merge([ 'sale_price4' => $this->salePrice4, ]);
        }
        if ($this->salePrice5) {
            $this->merge([ 'sale_price5' => $this->salePrice5, ]);
        }
        if ($this->lastDatePrice1) {
            $this->merge([ 'last_date_price1' => $this->lastDatePrice1, ]);
        }
        if ($this->lastDatePrice2) {
            $this->merge([ 'last_date_price2' => $this->lastDatePrice2, ]);
        }
        if ($this->lastDatePrice3) {
            $this->merge([ 'last_date_price3' => $this->lastDatePrice3, ]);
        }
        if ($this->lastDatePrice4) {
            $this->merge([ 'last_date_price4' => $this->lastDatePrice4, ]);
        }
        if ($this->lastDatePrice5) {
            $this->merge([ 'last_date_price5' => $this->lastDatePrice5, ]);
        }
        if ($this->realStock) {
            $this->merge([ 'real_stock' => $this->realStock, ]);
        }
        if ($this->commitedStock) {
            $this->merge([ 'commited_stock' => $this->commitedStock, ]);
        }
        if ($this->commingStock) {
            $this->merge([ 'comming_stock' => $this->commingStock, ]);
        }
        if ($this->dispatchStock) {
            $this->merge([ 'dispatch_stock' => $this->dispatchStock, ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->updateBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }

}
