<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class OrderFilter extends ApiFilter
{

    protected $safeParms = [
        'id'                   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'customer_id'          => ['eq', 'ne'],
        'seller_id'            => ['eq', 'ne'],
        'transport_id'         => ['eq', 'ne'],
        'status'               => ['eq', 'ne'],
        'order_date'           => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'payment_condition_id' => ['eq', 'ne'],
        'currency_id'          => ['eq', 'ne'],
        'due_date'             => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'rate'                 => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'balance'              => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'mustBeSync'           => ['eq', 'ne'],
        'syncAt'               => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'            => ['eq', 'ne'],
        'updatedBy'            => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'customerId'         => 'customer_id',
        'sellerId'           => 'seller_id',
        'transportId'        => 'transport_id',
        'orderDate'          => 'order_date',
        'paymentConditionId' => 'payment_condition_id',
        'currencyId'         => 'currency_id',
        'dueDate'            => 'due_date',
        'mustBeSync'         => 'must_be_sync',
        'syncAt'             => 'sync_at',
        'createdBy'          => 'created_by',
        'updatedBy'          => 'updated_by',
    ];


}
