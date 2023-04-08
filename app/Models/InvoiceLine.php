<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceLine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'line_number',
        'origin_document_type',
        'origin_line_number',
        'article_id',
        'warehouse_id',
        'sub_total',
        'qty',
        'qty_secondary_unit',
        'pending',
        'sale_unit',
        'sale_price',
        'discounts',
        'tax_type',
        'net_line',
        'average_unit_cost',
        'last_unit_cost',
        'average_unit_cost_oc',
        'last_unit_cost_oc',
        'pay_back_amount',
        'pay_back_total',
        'sale_price_oc',
        'article_generic_description',
        'comments',
        'total_units',
        'liqour_tax_amount',
        'lot_number',
        'lot_date',
        'aux01',
        'aux02',
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
        'invoice_id' => 'integer',
        'article_id' => 'integer',
        'warehouse_id' => 'integer',
        'sub_total' => 'decimal:5',
        'qty' => 'decimal:5',
        'qty_secondary_unit' => 'decimal:5',
        'pending' => 'decimal:5',
        'sale_price' => 'decimal:5',
        'net_line' => 'decimal:5',
        'average_unit_cost' => 'decimal:5',
        'last_unit_cost' => 'decimal:5',
        'average_unit_cost_oc' => 'decimal:5',
        'last_unit_cost_oc' => 'decimal:5',
        'pay_back_amount' => 'decimal:5',
        'pay_back_total' => 'decimal:5',
        'sale_price_oc' => 'decimal:5',
        'total_units' => 'decimal:5',
        'liqour_tax_amount' => 'decimal:5',
        'lot_date' => 'datetime',
        'aux01' => 'decimal:5',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
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
