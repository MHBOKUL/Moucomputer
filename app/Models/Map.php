<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    protected $fillable = [
        'mouza_id',
        'title',
        'file_path',
        'file_name',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Map belongs to a Mouza.
     */
    public function mouza(): BelongsTo
    {
        return $this->belongsTo(Mouza::class);
    }

    /**
     * Map has many Orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
