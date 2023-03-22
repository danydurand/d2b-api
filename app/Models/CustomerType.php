<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerType extends Model
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
        'price_list_id',
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
        'price_list_id' => 'integer',
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public $appends = [
        'creator',
        'updator',
        'price_list_name',
    ];

    //------------
    // Accessors
    //------------

    protected function getPriceListNameAttribute()
    {
        return $this->priceList->name;
    }


    protected function getCreatorAttribute()
    {
        return $this->created_by ? User::find($this->created_by)->name_id : null;
    }

    protected function getUpdatorAttribute()
    {
        return $this->updated_by ? User::find($this->updated_by)->name_id : null;
    }

    //---------------
    // Relationships
    //---------------

    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class);
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
