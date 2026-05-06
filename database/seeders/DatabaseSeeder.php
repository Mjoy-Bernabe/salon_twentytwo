<?php

namespace Database\Seeders;
use Database\Seeders\StylistSeeder;

use App\Models\User;
use Database\Seeders\AdminSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

User::firstOrCreate(
    ['email' => 'test@example.com'], // check
    [
        'name' => 'Test User',
        'password' => bcrypt('password'), // required if not using factory
    ]
);
        $this->call(AdminSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StylistSeeder::class);
    }
}
