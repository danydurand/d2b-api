<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockWarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'warehouseId'      => $this->warehouse_id,
            'articleId'        => $this->article_id,
            'actualAtock'      => $this->actual_stock,
            'actualSstock'     => $this->actual_sstock,
            'commitedStock'    => $this->commited_stock,
            'commitedSstock'   => $this->commited_sstock,
            'toArriveStock'    => $this->to_arrive_stock,
            'toArriveSstock'   => $this->to_arrive_sstock,
            'toDispatchStock'  => $this->to_dispatch_stock,
            'toDispatchSstock' => $this->to_dispatch_sstock,
            'checked'          => $this->checked,
            'mustBeSync'       => $this->must_be_sync,
            'syncAt'           => $this->sync_at ? $this->sync_at->toDateTimeString() : null,
            'createdAt'        => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updatedAt'        => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
