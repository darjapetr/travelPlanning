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
                'name' => 'Lake Park',
                'type' => 'entertainment',
                'price' => 20.00,
                'description' => 'A beautiful park with multiple mountain lakes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
