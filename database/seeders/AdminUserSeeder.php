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
        'email' => env('ADMIN_EMAIL', 'admin@example.com'),
        'password' => Hash::make(env('ADMIN_PASSWORD', 'changeme123')),
        'role' => 'admin',
    ]);

    }
}
