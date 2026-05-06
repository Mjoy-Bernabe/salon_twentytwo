<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['service_name' => 'HAIRCUT', 'price' => 250, 'is_promo' => false],
            ['service_name' => 'HAIR COLOR', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'BLOW DRY', 'price' => 150, 'is_promo' => false],
            ['service_name' => 'CURL IRON', 'price' => 359, 'is_promo' => false],
            ['service_name' => 'TRADITIONAL PERM', 'price' => 350, 'is_promo' => false],
            ['service_name' => 'BRAZILLIAN', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'COLLAGEN', 'price' => 3500, 'is_promo' => false],
            ['service_name' => 'CYSTEINE ALPHA', 'price' => 4500, 'is_promo' => false],
            ['service_name' => 'NANO PLASTY', 'price' => 5000, 'is_promo' => false],
            ['service_name' => 'REBOND', 'price' => 2500, 'is_promo' => false],
            ['service_name' => 'HAIR MASK', 'price' => 800, 'is_promo' => false],
            ['service_name' => 'BOTOX', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'BALAYAGE', 'price' => 5000, 'is_promo' => false],
            ['service_name' => 'HIGHLIGHTS', 'price' => 2500, 'is_promo' => false],
            ['service_name' => 'HAIR AND MAKE UP', 'price' => 1500, 'is_promo' => false],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['service_name' => $service['service_name']],
                ['price' => $service['price'], 'is_promo' => $service['is_promo']]
            );
        }
    }
}
