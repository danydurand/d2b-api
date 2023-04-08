<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class InvoiceFilter extends ApiFilter
{

    protected $safeParms = [
        'id'                       => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'name'                     => ['eq', 'ne'],
        'fiscalNumber'             => ['eq', 'ne'],
        'fiscalNumber2'            => ['eq', 'ne'],
        'customerId'               => ['eq', 'ne'],
        'sellerId'                 => ['eq', 'ne'],
        'transportId'              => ['eq', 'ne'],
        'currencyId'               => ['eq', 'ne'],
        'branchId'                 => ['eq', 'ne'],
        'paymentConditionId'       => ['eq', 'ne'],
        'controlNumber'            => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'status'                   => ['eq', 'ne'],
        'exchangeRate'             => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'description'              => ['eq', 'ne'],
        'balance'                  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'billDate'                 => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'dueDate'                  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'grossAmount'              => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'netAmount'                => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'globalDiscountPercentage' => ['eq', 'ne'],
        'globalDiscountAmount'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'mustBeSync'               => ['eq', 'ne'],
        'syncAt'                   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'                => ['eq', 'ne'],
        'updatedBy'                => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'fiscalNumber'             => 'fiscal_number',
        'fiscalNumber2'            => 'fiscal_number2',
        'customerId'               => 'customer_id',
        'sellerId'                 => 'seller_id',
        'transportId'              => 'transport_id',
        'currencyId'               => 'currency_id',
        'branchId'                 => 'brand_id',
        'paymentConditionId'       => 'payment_condition_id',
        'controlNumber'            => 'control_number',
        'dueDate'                  => 'due_date',
        'exchangeRate'             => 'exchange_rate',
        'billDate'                 => 'bill_date',
        'grossAmount'              => 'gross_amount',
        'netAmount'                => 'net_amount',
        'globalDiscountPercentage' => 'global_discount_percentage',
        'globalDiscountAmount'     => 'global_discount_amount',
        'mustBeSync'               => 'must_be_sync',
        'syncAt'                   => 'sync_at',
        'createdBy'                => 'created_by',
        'updatedBy'                => 'updated_by',
    ];


}
