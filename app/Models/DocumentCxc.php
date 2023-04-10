<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentCxc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_type_id',
        'document_number',
        'nullified',
        'control_number',
        'customer_id',
        'seller_id',
        'branch_id',
        'is_tax_payer',
        'document_date',
        'due_date',
        'tax_type',
        'exchange_rate',
        'currency_id',
        'tax_amount',
        'gross_amount',
        'discounts',
        'discount_amount',
        'surcharge',
        'surcharge_amount',
        'other_amount',
        'net_amount',
        'balance',
        'liqour_tax_amount',
        'comments',
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
        'record_date',
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
        'document_type_id' => 'integer',
        'nullified' => 'boolean',
        'customer_id' => 'integer',
        'seller_id' => 'integer',
        'branch_id' => 'integer',
        'is_tax_payer' => 'boolean',
        'document_date' => 'datetime',
        'due_date' => 'datetime',
        'exchange_rate' => 'decimal:5',
        'currency_id' => 'integer',
        'tax_amount' => 'decimal:5',
        'gross_amount' => 'decimal:5',
        'discount_amount' => 'decimal:5',
        'surcharge_amount' => 'decimal:5',
        'other_amount' => 'decimal:5',
        'net_amount' => 'decimal:5',
        'balance' => 'decimal:5',
        'liqour_tax_amount' => 'decimal:5',
        'other1' => 'decimal:5',
        'other2' => 'decimal:5',
        'other3' => 'decimal:5',
        'aux01' => 'decimal:5',
        'record_date' => 'datetime',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
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
