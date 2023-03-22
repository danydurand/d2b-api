<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class CustomerTypeFilter extends ApiFilter
{

    protected $safeParms = [
        'id' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'code' => ['eq','ne'],
        'description' => ['eq'],
        'priceListId' => ['eq','ne'],
        'mustBeSync' => ['eq','ne'],
        'syncAt' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy' => ['eq','ne'],
        'updatedBy' => ['eq','ne'],
    ];

    protected $columnMap = [
        'priceListId' => 'price_list_id',
        'mustBeSync' => 'must_be_sync',
        'syncAt' => 'sync_at',
        'createdBy' => 'created_by',
        'updatedBy' => 'updated_by',
    ];


}
