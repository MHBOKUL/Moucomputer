<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function mouza(): BelongsTo
    {
        return $this->belongsTo(Mouza::class);
    }
}