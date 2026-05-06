<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
   

    public function run()
    {
        Customer::create([
            'name' => 'Cha',
            'contact_num' => '09913353',
            'email' => 'cha@gmail.com'
        ]);
    }
}
