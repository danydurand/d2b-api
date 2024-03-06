<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sales_commission',
        'collect_commission',
        'login',
        'password',
        'last_login_at',
        'must_be_sync',
        'sync_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'sales_commission'   => 'decimal:2',
        'collect_commission' => 'decimal:2',
        'last_login_at'      => 'datetime',
        'must_be_sync'       => 'boolean',
        'sync_at'            => 'datetime',
        'created_by'         => 'integer',
        'updated_by'         => 'integer',
    ];

    public $appends = [
        'customers_count',
    ];


    //--------------
    // Mutators
    //--------------
    public function setNameAttribute($value)
    {
        return $this->name = strtoupper($value);
    }

    //--------------
    // Atttributes
    //--------------
    public function getCustomersCountAttribute()
    {
        return $this->customers()->count();
    }

    //----------------
    // Relationships
    //----------------
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
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
