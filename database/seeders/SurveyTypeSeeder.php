<?php

namespace Database\Seeders;

use App\Models\SurveyType;
use Illuminate\Database\Seeder;

class SurveyTypeSeeder extends Seeder
{
    public function run(): void
    {
        SurveyType::create([
            'name' => 'CS',
            'name_bn' => 'সি এস',
            'is_active' => true,
        ]);

        SurveyType::create([
            'name' => 'SA',
            'name_bn' => 'এস এ',
            'is_active' => true,
        ]);

        SurveyType::create([
            'name' => 'RS',
            'name_bn' => 'আর এস',
            'is_active' => true,
        ]);
    }
}