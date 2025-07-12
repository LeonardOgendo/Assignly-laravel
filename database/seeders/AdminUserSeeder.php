<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@cytonn.com',
            'password' => Hash::make('EternalBlue'),
            'role' => 'admin', // Make sure the 'role' column exists in users table
        ]);
    }
}
