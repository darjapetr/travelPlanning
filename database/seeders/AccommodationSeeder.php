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
                'location' => 'Lakeview',
                'type' => 'glamping',
                'price' => 120.00,
                'description' => 'A beautiful cozy cottage by the lake.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luxury Resort',
                'location' => 'Beachside',
                'type' => 'hotel',
                'price' => 300.00,
                'description' => 'An all-inclusive luxury resort with ocean views.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
