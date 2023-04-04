<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'customer_id',
        'seller_id',
        'transport_id',
        'status',
        'description',
        'order_date',
        'payment_condition_id',
        'currency_id',
        'due_date',
        'comments',
        'rate',
        'balance',
        'gross_amount',
        'net_amount',
        'global_discount',
        'total_surcharge',
        'total_freight',
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
        'customer_id' => 'integer',
        'seller_id' => 'integer',
        'transport_id' => 'integer',
        'order_date' => 'datetime',
        'payment_condition_id' => 'integer',
        'currency_id' => 'integer',
        'due_date' => 'datetime',
        'rate' => 'decimal:5',
        'balance' => 'decimal:5',
        'gross_amount' => 'decimal:5',
        'net_amount' => 'decimal:5',
        'global_discount' => 'decimal:5',
        'total_surcharge' => 'decimal:5',
        'total_freight' => 'decimal:5',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class);
    }

    public function paymentCondition(): BelongsTo
    {
        return $this->belongsTo(PaymentCondition::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
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
