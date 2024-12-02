<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->insert([
            [
                'name_en' => 'Lake Park',
                'name_lt' => 'Ežerų parkas',
                'city_en' => 'Como',
                'city_lt' => 'Komo',
                'country_en' => 'Italy',
                'country_lt' => 'Italija',
                'address' => 'Via Carlo Dotti, 1, 22010 Argegno CO',
                'description_en' => 'A beautiful park with multiple mountain lakes.',
                'description_lt' => 'Gražus parkas su keliais kalnų ežerais.',
                'type' => 'entertainment',
                'price' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
