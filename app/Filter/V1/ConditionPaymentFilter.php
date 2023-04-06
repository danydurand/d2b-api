<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class ConditionPaymentFilter extends ApiFilter
{

    protected $safeParms = [
        'id'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'description' => ['eq', 'ne'],
        'branch_id'   => ['eq', 'ne'],
        'creditDays'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'mustBeSync'  => ['eq', 'ne'],
        'syncAt'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'   => ['eq', 'ne'],
        'updatedBy'   => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'branchId'    => 'branch_id',
        'creditDays'  => 'credit_days',
        'mustBeSync'  => 'must_be_sync',
        'syncAt'      => 'sync_at',
        'createdBy'   => 'created_by',
        'updatedBy'   => 'updated_by',
    ];


}
