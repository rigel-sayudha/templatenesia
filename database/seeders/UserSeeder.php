<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@templatenesia.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
            ]
        );

        // Create demo user
        User::firstOrCreate(
            ['email' => 'demo@templatenesia.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
