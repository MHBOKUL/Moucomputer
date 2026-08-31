<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Khatian extends Model
{
    protected $fillable = [
        'mouza_id',
        'survey_type_id',
        'khatian_number',
        'owner_name',
        'pdf_path',
        'price',
        'is_active',
    ];


    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | MOUZA
    |--------------------------------------------------------------------------
    */

    public function mouza(): BelongsTo
    {
        return $this->belongsTo(Mouza::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SURVEY TYPE
    |--------------------------------------------------------------------------
    */

    public function surveyType(): BelongsTo
    {
        return $this->belongsTo(SurveyType::class);
    }


    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}