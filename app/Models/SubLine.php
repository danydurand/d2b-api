<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubLine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'line_id',
        'description',
        'must_be_sync',
        'batch',
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
        'id'           => 'integer',
        'line_id'      => 'integer',
        'must_be_sync' => 'boolean',
        'bacth'        => 'boolean',
        'sync_at'      => 'datetime',
        'created_by'   => 'integer',
        'updated_by'   => 'integer',
    ];

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
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
