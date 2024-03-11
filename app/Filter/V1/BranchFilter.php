<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class BranchFilter extends ApiFilter
{

    protected $safeParms = [
        'id'           => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'description'  => ['eq'],
        'must_be_sync' => ['eq', 'ne'],
        'batch'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'sync_at'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'created_by'   => ['eq', 'ne'],
        'updated_by'   => ['eq', 'ne'],
    ];

    // protected $columnMap = [
    //     'mustBeSync' => 'must_be_sync',
    //     'syncAt'     => 'sync_at',
    //     'createdBy'  => 'created_by',
    //     'updatedBy'  => 'updated_by',
    // ];


}
