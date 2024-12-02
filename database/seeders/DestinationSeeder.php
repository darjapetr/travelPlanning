<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('destinations')->insert([
            [
                'city_en' => 'Milan',
                'country_en' => 'Italy',
                'description_en' => 'A beautiful city.',
                'city_lt' => 'Milanas',
                'country_lt' => 'Italija',
                'description_lt' => 'Gražus miestas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
