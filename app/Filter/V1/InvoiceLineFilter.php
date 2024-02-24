<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class InvoiceLineFilter extends ApiFilter
{

    protected $safeParms = [
        'id'                 => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'invoiceId'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lineNumber'         => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'originDocumentType' => ['eq', 'ne'],
        'originLineNumber'   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'articleId'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'warehouseId'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'subTotal'           => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'qty'                => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lotNumber'          => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lotDate'            => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'mustBeSync'         => ['eq', 'ne'],
        'syncAt'             => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'          => ['eq', 'ne'],
        'updatedBy'          => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'invoiceId'          => 'invoice_id',
        'lineNumber'         => 'line_number',
        'originDocumentType' => 'origin_document_type',
        'originLineNumber'   => 'origin_line_number',
        'articleId'          => 'article_id',
        'warehouseId'        => 'warehouse_id',
        'subTotal'           => 'sub_total',
        'lotNumber'          => 'lot_number',
        'lotDate'            => 'lot_date',
        'mustBeSync'         => 'must_be_sync',
        'syncAt'             => 'sync_at',
        'createdBy'          => 'created_by',
        'updatedBy'          => 'updated_by',
    ];


}
