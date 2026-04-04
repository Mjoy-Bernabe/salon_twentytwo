<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = [
            (object)['icon' => '✂', 'name' => 'Hair Styling', 'description' => 'Cut, color, and styling by expert hair artists using premium products.', 'price' => 350],
            (object)['icon' => '💅', 'name' => 'Nail Care', 'description' => 'Manicure, pedicure, and nail art with long-lasting gel options.', 'price' => 200],
            (object)['icon' => '✨', 'name' => 'Facial Treatments', 'description' => 'Deep cleansing, brightening, and anti-aging facials for glowing skin.', 'price' => 500],
            (object)['icon' => '🌿', 'name' => 'Waxing & Threading', 'description' => 'Precise and gentle hair removal for smooth, flawless results.', 'price' => 150],
            (object)['icon' => '💆', 'name' => 'Head Massage', 'description' => 'Relaxing scalp massage that relieves stress and promotes hair health.', 'price' => 250],
            (object)['icon' => '👰', 'name' => 'Bridal Package', 'description' => 'Complete hair and makeup package for your most special day.', 'price' => 3500],
        ];

        $testimonials = [
            (object)['name' => 'Maria Santos', 'message' => 'Amazing experience! The staff is so professional and the place is so clean and relaxing. My hair looks absolutely stunning!'],
            (object)['name' => 'Jessa Reyes', 'message' => 'Best nail art in the city! I always leave feeling confident and beautiful. Highly recommend their gel manicure.'],
            (object)['name' => 'Rina Dela Cruz', 'message' => 'I got the bridal package and it was worth every peso. My makeup and hair were perfect throughout the entire wedding!'],
        ];

        return view('home', compact('services', 'testimonials'));
    }
}