<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'description',
        'business_id',
        'brand_id',
        'sub_brand_id',
        'category_id',
        'line_id',
        'sub_line_id',
        'colour_id',
        'origin_id',
        'article_type_id',
        'provider_id',
        'sale_unit_id',
        'ssale_unit_id',
        'reference',
        'model',
        'comments',
        'compose',
        'picture',
        'field1',
        'field2',
        'field3',
        'field4',
        'field5',
        'x_11',
        'x_12',
        'weight',
        'feet',
        'sale_price1',
        'sale_price2',
        'sale_price3',
        'sale_price4',
        'sale_price5',
        'last_date_price1',
        'last_date_price2',
        'last_date_price3',
        'last_date_price4',
        'last_date_price5',
        'real_stock',
        'commited_stock',
        'comming_stock',
        'dispatch_stock',
        'sreal_stock',
        'scommited_stock',
        'scomming_stock',
        'sdispatch_stock',
        'margin1',
        'margin2',
        'margin3',
        'margin4',
        'margin5',
        'must_be_sync',
        'sync_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'brand_id' => 'integer',
        'sub_brand_id' => 'integer',
        'category_id' => 'integer',
        'line_id' => 'integer',
        'sub_line_id' => 'integer',
        'colour_id' => 'integer',
        'origin_id' => 'integer',
        'article_type_id' => 'integer',
        'provider_id' => 'integer',
        'sale_unit_id' => 'integer',
        'ssale_unit_id' => 'integer',
        'compose' => 'boolean',
        'x_11' => 'decimal:5',
        'x_12' => 'decimal:5',
        'weight' => 'decimal:5',
        'feet' => 'decimal:5',
        'sale_price1' => 'decimal:5',
        'sale_price2' => 'decimal:5',
        'sale_price3' => 'decimal:5',
        'sale_price4' => 'decimal:5',
        'sale_price5' => 'decimal:5',
        'last_date_price1' => 'datetime',
        'last_date_price2' => 'datetime',
        'last_date_price3' => 'datetime',
        'last_date_price4' => 'datetime',
        'last_date_price5' => 'datetime',
        'real_stock' => 'decimal:5',
        'commited_stock' => 'decimal:5',
        'comming_stock' => 'decimal:5',
        'dispatch_stock' => 'decimal:5',
        'sreal_stock' => 'decimal:5',
        'scommited_stock' => 'decimal:5',
        'scomming_stock' => 'decimal:5',
        'sdispatch_stock' => 'decimal:5',
        'margin1' => 'decimal:5',
        'margin2' => 'decimal:5',
        'margin3' => 'decimal:5',
        'margin4' => 'decimal:5',
        'margin5' => 'decimal:5',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function subBrand(): BelongsTo
    {
        return $this->belongsTo(SubBrand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
    }

    public function subLine(): BelongsTo
    {
        return $this->belongsTo(SubLine::class);
    }

    public function colour(): BelongsTo
    {
        return $this->belongsTo(Colour::class);
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(Origin::class);
    }

    public function articleType(): BelongsTo
    {
        return $this->belongsTo(ArticleType::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function saleUnit(): BelongsTo
    {
        return $this->belongsTo(SaleUnit::class);
    }

    public function ssaleUnit(): BelongsTo
    {
        return $this->belongsTo(SsaleUnit::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
