<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'password' => Hash::make('admintest'),
                'role_id' => 1
            ],
            [
                'email' => 'user@gmail.com',
                'name' => 'user',
                'password' => Hash::make('usertest'),
                'role_id' => 2
            ]
        ];

        foreach ($items as $item) {
            $email = $item['email'];
            unset($item['email']);
            (new User)->firstOrCreate(['email' => $email], $item);
        }
    }
}
