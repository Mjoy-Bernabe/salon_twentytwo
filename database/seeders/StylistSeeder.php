<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use App\Models\Stylist;


class StylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run()
    {
        $stylists = ['Joy', 'Vince', 'Cha', 'JM'];

        foreach ($stylists as $name) {
            Stylist::create(['name' => $name]);
        }
    }
}
