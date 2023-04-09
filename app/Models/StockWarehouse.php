<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockWarehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'article_id',
        'actual_stock',
        'actual_sstock',
        'commited_stock',
        'commited_sstock',
        'to_arrive_stock',
        'to_arrive_sstock',
        'to_dispatch_stock',
        'to_dispatch_sstock',
        'checked',
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
        'actual_stock' => 'decimal:5',
        'actual_sstock' => 'decimal:5',
        'commited_stock' => 'decimal:5',
        'commited_sstock' => 'decimal:5',
        'to_arrive_stock' => 'decimal:5',
        'to_arrive_sstock' => 'decimal:5',
        'to_dispatch_stock' => 'decimal:5',
        'to_dispatch_sstock' => 'decimal:5',
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
