<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
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
                'batch'            => ['required', 'integer'],
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
            ];
        } else {
            return [
                'code'             => ['sometimes', 'required', 'string', 'max:30', Rule::unique('articles')->ignore($id)],
                'description'      => ['sometimes', 'required', 'string', 'max:100', Rule::unique('articles')->ignore($id)],
                'batch'            => ['required', 'integer'],
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
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (strlen($this->code)) {
            $this->merge([ 'code' => $this->code ]);
        }
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        $this->merge([
            'must_be_sync' => false,
            'sync_at'      => Carbon::now()->toDateTimeString(),
            'updated_by'   => 1,
            'updated_at'   => Carbon::now()->toDateTimeString(),
        ]);
    }

}
