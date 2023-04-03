<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'code'           => $this->code,
            'description'    => $this->description,
            'businessId'     => $this->business_id,
            'brandId'        => $this->brand_id,
            'subBrandId'     => $this->sub_brand_id,
            'categoryId'     => $this->category_id,
            'lineId'         => $this->line_id,
            'subLineId'      => $this->sub_line_id,
            'colourId'       => $this->colour_id,
            'originId'       => $this->origin_id,
            'articleTypeId'  => $this->article_type_id,
            'providerId'     => $this->provider_id,
            'saleUnitId'     => $this->sale_unit_id,
            'ssaleUnitId'    => $this->ssale_unit_id,
            'reference'      => $this->reference,
            'model'          => $this->model,
            'comments'       => $this->comments,
            'compose'        => $this->compose,
            'picture'        => $this->picture,
            'field1'         => $this->field1,
            'field2'         => $this->field2,
            'field3'         => $this->field3,
            'field4'         => $this->field4,
            'field5'         => $this->field5,
            'x_12'           => $this->x_12,
            'x_11'           => $this->x_11,
            'weight'         => $this->weight,
            'feet'           => $this->feet,
            'sale_price1'    => $this->sale_price1,
            'sale_price2'    => $this->sale_price2,
            'sale_price3'    => $this->sale_price3,
            'sale_price4'    => $this->sale_price4,
            'sale_price5'    => $this->sale_price5,
            'lastDatePrice1' => $this->last_date_price1,
            'lastDatePrice2' => $this->last_date_price2,
            'lastDatePrice3' => $this->last_date_price3,
            'lastDatePrice4' => $this->last_date_price4,
            'lastDatePrice5' => $this->last_date_price5,
            'realStock'      => $this->real_stock,
            'commitedStock'  => $this->commited_stock,
            'commingStock'   => $this->comming_stock,
            'dispatchStock'  => $this->dispatch_stock,
            'srealStock'     => $this->sreal_stock,
            'scommitedStock' => $this->scommited_stock,
            'scommingStock'  => $this->scomming_stock,
            'sdispatchStock' => $this->sdispatch_stock,
            'margin1'        => $this->margin1,
            'margin2'        => $this->margin2,
            'margin3'        => $this->margin3,
            'margin4'        => $this->margin4,
            'margin5'        => $this->margin5,
            'mustBeSync'     => $this->must_be_sync,
            'syncAt'         => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'      => $this->created_at->toDateTimeString(),
            'updatedAt'      => $this->updated_at->toDateTimeString(),
        ];
    }
}
