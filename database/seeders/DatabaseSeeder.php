<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stylist; // ✅ needed here

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders
        $this->call([
            ServiceSeeder::class,
            StylistSeeder::class,
            CustomerSeeder::class,
            StylistScheduleSeeder::class,
        ]);

        // Assign services to stylist
        $stylist = Stylist::find(1);

        if ($stylist) {
            $stylist->services()->attach([1,2,3,4,5]);
        }
    }
}
