<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accommodations')->insert([
            [
                'name' => 'Cozy Cottage',
                'city_en' => 'Lakeview',
                'city_lt' => 'Lakeview',
                'country_en' => 'Lakeview',
                'country_lt' => 'Lakeview',
                'address' => 'Lakeview',
                'type' => 'glamping',
                'price' => 120.00,
                'description_en' => 'A beautiful cozy cottage by the lake.',
                'description_lt' => 'A beautiful cozy cottage by the lake.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
