<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class BrandFilter extends ApiFilter
{

    protected $safeParms = [
        'id'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
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
