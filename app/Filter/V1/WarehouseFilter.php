<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class WarehouseFilter extends ApiFilter
{

    protected $safeParms = [
        'id'                   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'code'                 => ['eq', 'ne'],
        'description'          => ['eq'],
        'isRestrictedSales'    => ['eq', 'ne'],
        'isRestrictedPurchase' => ['eq', 'ne'],
        'mustBeSync'           => ['eq', 'ne'],
        'syncAt'               => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'            => ['eq', 'ne'],
        'updatedBy'            => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'isRestrictedSales'    => 'is_restricted_sales',
        'isRestrictedPurchase' => 'is_restricted_purchase',
        'mustBeSync'           => 'must_be_sync',
        'syncAt'               => 'sync_at',
        'createdBy'            => 'created_by',
        'updatedBy'            => 'updated_by',
    ];


}
