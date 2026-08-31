<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyType extends Model
{
    protected $fillable = [
        'name',
        'name_bn',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function khatians()
{
    return $this->hasMany(Khatian::class);
}
}