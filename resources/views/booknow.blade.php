@extends('layouts.app')

@section('content')

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100">
    <a href="{{ route('home') }}" class="text-sm font-bold tracking-widest uppercase hover:opacity-80 transition-opacity">
        Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
    </a>
    <ul class="flex gap-10 list-none">
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">About</a></li>
        <li><a href="{{ route('services.index') }}" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Services</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Gallery</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Find Us</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Contact</a></li>
    </ul>
    <div class="flex gap-8 items-center">
        <a href="#" class="text-xs font-semibold tracking-widest uppercase text-gray-400 hover:text-black transition-colors">Sign In</a>
        <div class="flex gap-5">
            <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
            <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
        </div>
    </div>
</nav>

{{-- Hero Section --}}
<section class="relative h-[45vh] bg-black overflow-hidden flex items-center justify-center text-center">
    <img src="{{ asset('images/services.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Booking Background">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative z-10">
        <p class="text-[12px] font-bold tracking-[0.4em] uppercase text-yellow-500 mb-4">Quality hair services at friendly prices!</p>
        <h1 class="text-7xl font-bold text-white tracking-tight">Booking</h1>
    </div>
</section>

<section class="bg-stone-50 py-16 px-4 md:px-12">
    <div class="max-w-[1400px] mx-auto">
        
   

        {{-- 3-Column Layout matching Reference image_42f6fc.png --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- 1. Left Sidebar: Categories --}}
            <div class="lg:col-span-2 flex flex-col border border-gray-200 bg-white shadow-sm">
                <button onclick="showBookingCategory('promos')" class="category-btn active p-5 text-left text-[11px] font-bold uppercase tracking-widest border-b border-gray-100 transition-all">
                    Salon Promos
                </button>
                <button onclick="showBookingCategory('hair')" class="category-btn p-5 text-left text-[11px] font-bold uppercase tracking-widest border-b border-gray-100 transition-all">
                    Signature Cut
                </button>
                <button onclick="showBookingCategory('colour')" class="category-btn p-5 text-left text-[11px] font-bold uppercase tracking-widest border-b border-gray-100 transition-all">
                    Signature Colour
                </button>
                <button onclick="showBookingCategory('special')" class="category-btn p-5 text-left text-[11px] font-bold uppercase tracking-widest transition-all">
                    Special Services
                </button>
            </div>

            {{-- 2. Middle Column: Service Selection --}}
            <div class="lg:col-span-6 bg-white border border-gray-200 shadow-sm">
               
                <div id="booking-promos" class="booking-list">
                    {{-- Service Item --}}
                    <label class="flex justify-between items-start p-8 border-b border-gray-100 hover:bg-stone-50 transition-all cursor-pointer">
                        <div class="max-w-md">
                            <h4 class="text-sm font-bold uppercase mb-2">Color + Hair Mask + Haircut</h4>
                            <p class="text-xs text-gray-400 font-light leading-relaxed">A complete transformation including professional coloring, deep hair mask treatment, and a precision signature cut.</p>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center gap-4 mb-1">
                                <span class="text-sm font-bold">₱1,500.00</span>
                                <input type="radio" name="selected_service" class="w-5 h-5 accent-black">
                            </div>
                            <span class="text-[11px] text-gray-400">90 min</span>
                        </div>
                    </label>

                    {{-- Service Item --}}
                    <label class="flex justify-between items-start p-8 border-b border-gray-100 hover:bg-stone-50 transition-all cursor-pointer">
                        <div class="max-w-md">
                            <h4 class="text-sm font-bold uppercase mb-2">Nano Plasty</h4>
                            <p class="text-xs text-gray-400 font-light leading-relaxed">Organic straightening and restorative treatment for mirror-like shine and frizz-free hair.</p>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center gap-4 mb-1">
                                <span class="text-sm font-bold">₱4,000.00</span>
                                <input type="radio" name="selected_service" class="w-5 h-5 accent-black">
                            </div>
                            <span class="text-[11px] text-gray-400">3 hrs</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 3. Right Sidebar: Salon Info (Matching image_42f6fc.png) --}}
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white border border-gray-200 p-6 shadow-sm">
                    <img src="{{ asset('images/services.jpg') }}" class="w-full h-48 object-cover mb-6" alt="Salon Interior">
                    
                    <div class="space-y-6 text-xs uppercase tracking-widest">
                        <div>
                            <h5 class="font-bold text-black mb-2">Opening Times</h5>
                            <p class="text-gray-500">Mon - Sun 10:00 AM - 10:00 PM</p>
                        </div>

                        <div>
                            <h5 class="font-bold text-black mb-2">Address</h5>
                            <p class="text-gray-500 flex items-start gap-2">
                                <svg class="h-3 w-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                Main Branch, Pasig City, Metro Manila
                            </p>
                        </div>

                        <div>
                            <h5 class="font-bold text-black mb-2">Cancellation Policy</h5>
                            <p class="text-gray-400 normal-case leading-relaxed">Please notify us at least 24 hours in advance if you need to cancel or reschedule your appointment.</p>
                        </div>
                    </div>
                </div>

                <button class="w-full bg-black text-white text-xs font-bold uppercase tracking-[0.3em] py-5 hover:bg-yellow-600 transition-all shadow-lg">
                    Continue to Details
                </button>
            </div>

        </div>
    </div>
</section>

<style>
    .category-btn.active {
        background-color: #1c1c1c;
        color: white;
    }
</style>

<script>
    function showBookingCategory(id) {
        document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }
</script>

@endsection