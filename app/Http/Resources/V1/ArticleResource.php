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
            'id'               => $this->id,
            'code'             => $this->code,
            'description'      => $this->description,
            'batch'            => $this->batch,
            'brand_id'         => $this->brand_id,
            'sub_brand_id'     => $this->sub_brand_id,
            'category_id'      => $this->category_id,
            'line_id'          => $this->line_id,
            'sub_line_id'      => $this->sub_line_id,
            'colour_id'        => $this->colour_id,
            'sale_unit_id'     => $this->sale_unit_id,
            'ssale_unit_id'    => $this->ssale_unit_id,
            'comments'         => $this->comments,
            'picture'          => $this->picture,
            'weight'           => $this->weight,
            'feet'             => $this->feet,
            'sale_price1'      => $this->sale_price1,
            'sale_price2'      => $this->sale_price2,
            'sale_price3'      => $this->sale_price3,
            'sale_price4'      => $this->sale_price4,
            'sale_price5'      => $this->sale_price5,
            'last_date_price1' => $this->last_date_price1,
            'last_date_price2' => $this->last_date_price2,
            'last_date_price3' => $this->last_date_price3,
            'last_date_price4' => $this->last_date_price4,
            'last_date_price5' => $this->last_date_price5,
            'real_stock'       => $this->real_stock,
            'commited_stock'   => $this->commited_stock,
            'sreal_stock'      => $this->sreal_stock,
            'scommited_stock'  => $this->scommited_stock,
            'must_be_sync'     => $this->must_be_sync,
            'sync_at'          => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}
