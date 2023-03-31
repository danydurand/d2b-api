<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class SubLineFilter extends ApiFilter
{

    protected $safeParms = [
        'id'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lineId'      => ['eq', 'ne'],
        'description' => ['eq'],
        'mustBeSync'  => ['eq', 'ne'],
        'syncAt'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'   => ['eq', 'ne'],
        'updatedBy'   => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'mustBeSync' => 'must_be_sync',
        'syncAt'     => 'sync_at',
        'createdBy'  => 'created_by',
        'updatedBy'  => 'updated_by',
    ];


}
