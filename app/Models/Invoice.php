<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fiscal_number',
        'fiscal_number2',
        'customer_id',
        'seller_id',
        'transport_id',
        'currency_id',
        'branch_id',
        'condition_payment_id',
        'control_number',
        'status',
        'exchange_rate',
        'description',
        'balance',
        'bill_date',
        'due_date',
        'comments',
        'delivery_address',
        'gross_amount',
        'net_amount',
        'global_discount_percentage',
        'global_discount_amount',
        'surcharge_percentage',
        'surcharge_amount',
        'freight_amount',
        'pay_back_amount',
        'tax_amount',
        'pay_back_tax_amount',
        'liqour_tax_amount',
        'nullified',
        'printed',
        'field1',
        'field2',
        'field3',
        'field4',
        'field5',
        'field6',
        'field7',
        'field8',
        'other1',
        'other2',
        'other3',
        'aux01',
        'aux02',
        'generic_customer_phone',
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
        'currency_id' => 'integer',
        'branch_id' => 'integer',
        'condition_payments_id' => 'integer',
        'exchange_rate' => 'decimal:5',
        'balance' => 'decimal:5',
        'bill_date' => 'datetime',
        'due_date' => 'datetime',
        'gross_amount' => 'decimal:5',
        'net_amount' => 'decimal:5',
        'global_discount_amount' => 'decimal:5',
        'surcharge_amount' => 'decimal:5',
        'freight_amount' => 'decimal:5',
        'pay_back_amount' => 'decimal:5',
        'tax_amount' => 'decimal:5',
        'pay_back_tax_amount' => 'decimal:5',
        'liqour_tax_amount' => 'decimal:5',
        'nullified' => 'boolean',
        'printed' => 'boolean',
        'other1' => 'decimal:5',
        'other2' => 'decimal:5',
        'other3' => 'decimal:5',
        'aux01' => 'decimal:5',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];


    public function invoiceLines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

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

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function conditionPayment(): BelongsTo
    {
        return $this->belongsTo(ConditionPayment::class);
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
