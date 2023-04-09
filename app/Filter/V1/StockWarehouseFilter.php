<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class StockWarehouseFilter extends ApiFilter
{

    protected $safeParms = [
        'id'                => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'warehouse_id'      => ['eq', 'ne'],
        'article_id'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'actual_stock'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'commited_stock'    => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'to_arrive_stock'   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'to_dispatch_stock' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'checked'           => ['eq', 'ne'],
        'mustBeSync'        => ['eq', 'ne'],
        'syncAt'            => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'         => ['eq', 'ne'],
        'updatedBy'         => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'warehouseId'     => 'warehouse_id',
        'articleId'       => 'article_id',
        'actualStock'     => 'actual_stock',
        'commitedStock'   => 'commited_stock',
        'toArriveStock'   => 'to_arrive_stock',
        'toDispatchStock' => 'to_dispatch_stock',
        'mustBeSync'      => 'must_be_sync',
        'syncAt'          => 'sync_at',
        'createdBy'       => 'created_by',
        'updatedBy'       => 'updated_by',
    ];


}
