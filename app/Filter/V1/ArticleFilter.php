<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class ArticleFilter extends ApiFilter
{

    protected $safeParms = [
        'id'             => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'code'           => ['eq','ne'],
        'description'    => ['eq'],
        'businessId'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'brandId'        => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'subBrandId'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'categoryId'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lineId'         => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'subLineId'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'colourId'       => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'originId'       => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'articleTypeId'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'providerId'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'saleUnitId'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'sSaleUnitId'    => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'reference'      => ['eq', 'ne'],
        'model'          => ['eq', 'ne'],
        'compose'        => ['eq', 'ne'],
        'field1'         => ['eq', 'ne'],
        'field2'         => ['eq', 'ne'],
        'field3'         => ['eq', 'ne'],
        'field4'         => ['eq', 'ne'],
        'field5'         => ['eq', 'ne'],
        'lastDatePrice1' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lastDatePrice2' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lastDatePrice3' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lastDatePrice4' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'lastDatePrice5' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'realStock'      => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'commitedStock'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'commingStock'   => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'dispatchStock'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'srealStock'     => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'scommitedStock' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'scommingStock'  => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'sdispatchStock' => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'mustBeSync'     => ['eq', 'ne'],
        'syncAt'         => ['eq', 'ne', 'gt', 'lt', 'gte', 'lte'],
        'createdBy'      => ['eq', 'ne'],
        'updatedBy'      => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'businessId'     => 'busines_id',
        'brandId'        => 'brand_id',
        'subBrandId'     => 'sub_brand_id',
        'categoryId'     => 'category_id',
        'lineId'         => 'line_id',
        'subLineId'      => 'sub_line_id',
        'colourId'       => 'colour_id',
        'originId'       => 'origin_id',
        'articleTypeId'  => 'article_type_id',
        'providerId'     => 'provider_id',
        'saleUnitId'     => 'sale_unit_id',
        'sSaleUnitId'    => 'sSale_unit_id',
        'lastDatePrice1' => 'last_date_price1',
        'lastDatePrice2' => 'last_date_price2',
        'lastDatePrice3' => 'last_date_price3',
        'lastDatePrice4' => 'last_date_price4',
        'lastDatePrice5' => 'last_date_price5',
        'realStock'      => 'real_stock',
        'commitedStock'  => 'commited_stock',
        'commingStock'   => 'comming_stock',
        'dispatchStock'  => 'dispatch_stock',
        'srealStock'     => 'sreal_stock',
        'scommitedStock' => 'scommited_stock',
        'scommingStock'  => 'scomming_stock',
        'sdispatchStock' => 'sdispatch_stock',
        'mustBeSync'     => 'must_be_sync',
        'syncAt'         => 'sync_at',
        'createdBy'      => 'created_by',
        'updatedBy'      => 'updated_by',
    ];


}
