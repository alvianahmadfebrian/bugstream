<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'masteryoda',
            'email' => 'yoda@jedi.com',
            'password' => bcrypt('pisangkeju'),
            'role' => 'super_admin',
        ]);

        User::factory()->create([
            'name' => 'obiwan',
            'email' => 'obiwan@jedi.com',
            'password' => bcrypt('pisangkeju'),
            'role' => 'support_dev',
        ]);

        User::factory()->create([
            'name' => 'anakin',
            'email' => 'anakin@jedi.com',
            'password' => bcrypt('pisangkeju'),
            'role' => 'developer',
        ]);

        $this->call(NotificationSeeder::class);
    }
}
