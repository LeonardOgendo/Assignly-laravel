<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the admin user
        $this->call(AdminUserSeeder::class);

        // Also seed a few test users (optional)
        \App\Models\User::factory(3)->create();
    }
}
