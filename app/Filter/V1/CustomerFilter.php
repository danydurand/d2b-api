<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class CustomerFilter extends ApiFilter
{

    protected $safeParms = [
        'id'            => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'business_name' => ['eq'],
        'mustBeSync'    => ['eq', 'ne'],
        'syncAt'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'     => ['eq', 'ne'],
        'updatedBy'     => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'businessName' => 'business_name',
        'mustBeSync'   => 'must_be_sync',
        'syncAt'       => 'sync_at',
        'createdBy'    => 'created_by',
        'updatedBy'    => 'updated_by',
    ];


}
