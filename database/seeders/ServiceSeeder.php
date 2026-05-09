<?php

namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['service_name' => 'HAIRCUT', 'description' => 'Professional haircut tailored to your style and face shape.', 'price' => 250, 'is_promo' => false],
            ['service_name' => 'HAIR COLOR', 'description' => 'Complete hair coloring service with premium products.', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'BLOW DRY', 'description' => 'Professional blow dry for smooth, voluminous hair.', 'price' => 150, 'is_promo' => false],
            ['service_name' => 'CURL IRON', 'description' => 'Curling service using professional tools for beautiful waves.', 'price' => 359, 'is_promo' => false],
            ['service_name' => 'TRADITIONAL PERM', 'description' => 'Classic permanent wave treatment for curly hair.', 'price' => 350, 'is_promo' => false],
            ['service_name' => 'BRAZILLIAN', 'description' => 'Brazilian hair straightening treatment.', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'COLLAGEN', 'description' => 'Collagen treatment for hair repair and nourishment.', 'price' => 3500, 'is_promo' => false],
            ['service_name' => 'CYSTEINE ALPHA', 'description' => 'Advanced cysteine treatment for damaged hair.', 'price' => 4500, 'is_promo' => false],
            ['service_name' => 'NANO PLASTY', 'description' => 'Nano plastic treatment for hair reconstruction.', 'price' => 5000, 'is_promo' => false],
            ['service_name' => 'REBOND', 'description' => 'Hair rebonding service for straight, silky hair.', 'price' => 2500, 'is_promo' => false],
            ['service_name' => 'HAIR MASK', 'description' => 'Deep conditioning hair mask treatment.', 'price' => 800, 'is_promo' => false],
            ['service_name' => 'BOTOX', 'description' => 'Botox treatment for hair volume and repair.', 'price' => 1500, 'is_promo' => false],
            ['service_name' => 'BALAYAGE', 'description' => 'Hand-painted highlighting technique for natural look.', 'price' => 5000, 'is_promo' => false],
            ['service_name' => 'HIGHLIGHTS', 'description' => 'Professional hair highlighting service.', 'price' => 2500, 'is_promo' => false],
            ['service_name' => 'HAIR AND MAKE UP', 'description' => 'Complete hair styling and makeup service.', 'price' => 1500, 'is_promo' => false],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['service_name' => $service['service_name']],
                [
                    'description' => $service['description'],
                    'price' => $service['price'], 
                    'is_promo' => $service['is_promo']
                ]
            );
        }
    }
}
