<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mouza extends Model
{
    protected $fillable = [
        'upazila_id',
        'survey_type_id',
        'name',
        'name_bn',
        'jl_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function surveyType(): BelongsTo
    {
        return $this->belongsTo(SurveyType::class);
    }

    public function maps(): HasMany
    {
        return $this->hasMany(Map::class);
    }
}