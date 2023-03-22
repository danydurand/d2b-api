<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
        'must_be_sync' => 'boolean',
        'sync_at' => 'datetime:Y-m-d H:i:s',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public $appends = [
        'creator',
        'updator',
    ];

    //------------
    // Accessors
    //------------

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

    public function customerTypes()
    {
        return $this->hasMany(CustomerType::class);
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

}
