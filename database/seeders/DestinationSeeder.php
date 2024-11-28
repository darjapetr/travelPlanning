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
                'name' => 'Milan',
                'location' => 'Italy',
                'description' => 'A beautiful city.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
