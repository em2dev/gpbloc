<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quotes\QuoteType;

class QuoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuoteType::updateOrCreate(
            ['name' => 'rental'],
            [
                'name' => 'rental',
                'icon' => 'fa-regular fa-clock-five'
            ]
        );
        QuoteType::updateOrCreate(
            ['name' => 'sale'],
            [
                'name' => 'sale',
                'icon' => 'fa-regular fa-square-dollar'
            ]
        );
        QuoteType::updateOrCreate(
            ['name' => 'transportation'],
            [
                'name' => 'transportation',
                'icon' => 'fa-regular fa-truck'
            ]
        );

    }
}
