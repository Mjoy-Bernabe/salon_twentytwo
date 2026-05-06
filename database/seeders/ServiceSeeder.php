<?php

namespace Database\Seeders;
  use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
  

    public function run()
    {
        $services = [
            ['service_name' => 'Haircut', 'price' => 250],
            ['service_name' => 'Hair Color', 'price' => 1500],
            ['service_name' => 'Blow Dry', 'price' => 150],
            ['service_name' => 'Curl Iron', 'price' => 359],
            ['service_name' => 'Traditional Perm', 'price' => 350],
            ['service_name' => 'Brazilian', 'price' => 1500],
            ['service_name' => 'Collagen', 'price' => 3500],
            ['service_name' => 'Cysteine Alpha', 'price' => 4500],
            ['service_name' => 'Nano Plasty', 'price' => 5000],
            ['service_name' => 'Rebond', 'price' => 2500],
            ['service_name' => 'Hair Mask', 'price' => 800],
            ['service_name' => 'Botox', 'price' => 1500],
            ['service_name' => 'Balayage', 'price' => 5000],
            ['service_name' => 'Highlights', 'price' => 2500],
            ['service_name' => 'Hair and Make Up', 'price' => 1500],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
