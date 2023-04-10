<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class DocumentCxcFilter extends ApiFilter
{

    protected $safeParms = [
        'id'             => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'documentTypeId' => ['eq', 'ne'],
        'documentNumber' => ['eq', 'ne'],
        'nullified'      => ['eq', 'ne'],
        'controlNumber'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'customerId'     => ['eq', 'ne'],
        'sellerId'       => ['eq', 'ne'],
        'branchId'       => ['eq', 'ne'],
        'isTaxPayer'     => ['eq', 'ne'],
        'documentDate'   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'dueDate'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'taxType'        => ['eq', 'ne'],
        'exchangeRate'   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'currencyId'     => ['eq', 'ne'],
        'mustBeSync'     => ['eq', 'ne'],
        'syncAt'         => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'      => ['eq', 'ne'],
        'updatedBy'      => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'documentType'   => 'document_type',
        'documentNumber' => 'document_number',
        'controlNumber'  => 'control_number',
        'customerId'     => 'customer_id',
        'sellerId'       => 'seller_id',
        'branchId'       => 'brand_id',
        'currencyId'     => 'currency_id',
        'isTaxPayer'     => 'is_tax_payer',
        'documentDate'   => 'document_date',
        'dueDate'        => 'due_date',
        'taxType'        => 'taxType',
        'exchangeRate'   => 'exchange_rate',
        'mustBeSync'     => 'must_be_sync',
        'syncAt'         => 'sync_at',
        'createdBy'      => 'created_by',
        'updatedBy'      => 'updated_by',
    ];

}
