<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'map_id',
        'amount',
        'payment_method',
        'status',
        'download_allowed',
        'download_token',
        'download_count',
        'downloaded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'download_allowed' => 'boolean',
        'download_count' => 'integer',
        'downloaded_at' => 'datetime',
    ];

    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }
}