<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StylistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stylists')->insert([
            [
                'name' => 'Ricky Reyes',
                'contact' => '09123456789',
                'email' => 'ricky@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jing Monis',
                'contact' => '09234567890',
                'email' => 'jing@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Philip Reyes (Piandre Salon)',
                'contact' => '09345678901',
                'email' => 'philip@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Marky Strom',
                'contact' => '09456789012',
                'email' => 'marky@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jayjay Lucas',
                'contact' => '09567890123',
                'email' => 'jayjay@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nante Alingasa',
                'contact' => '09678901234',
                'email' => 'nante@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Renz Pangilinan',
                'contact' => '09789012345',
                'email' => 'renz@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Brent Sales',
                'contact' => '09890123456',
                'email' => 'brent@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rey Santos',
                'contact' => '09901234567',
                'email' => 'rey@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tony & Jackey Stylists',
                'contact' => '09912345678',
                'email' => 'tony.jackey@salon.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
