@extends('layouts.app')

@section('content')

<style>
    .nav-link { font-size: 13px; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: #6b7280; text-decoration: none; transition: color 0.3s ease; }
    .nav-link:hover { color: #d97706; }
    .filter-btn { font-size: 13px; font-weight: 800; text-transform: uppercase; border: none; background: none; color: #9ca3af; cursor: pointer; padding-bottom: 4px; border-bottom: 2px solid transparent; transition: all 0.3s ease; }
    .filter-btn.active { color: #111; border-bottom-color: #d97706; }
    .gallery-item { position: relative; overflow: hidden; background: #000; aspect-ratio: 4/5; }
    .gallery-img { width: 100%; height: 100%; object-fit: cover; opacity: 0.9; transition: all 0.7s ease; filter: grayscale(100%); }
    .gallery-item:hover .gallery-img { transform: scale(1.05); opacity: 1; filter: grayscale(0%); }
    .gallery-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: flex-end; padding: 20px; }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
</style>

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100">
  <a href="{{ route('home') }}" class="text-base font-bold tracking-widest uppercase">
    Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
  </a>
  <ul class="flex gap-10 list-none">
    <li><a href="{{ route('about') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">About</a></li>
    <li><a href="{{ route('services.index') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Services</a></li>
<li><a href="{{ route('gallery') }}" class="text-sm tracking-wider uppercase no-underline transition-all pb-1 
               {{ Route::is('gallery') ? 'text-yellow-600 font-bold border-b-2 border-yellow-600' : 'text-gray-500 font-medium hover:text-yellow-600' }}"
                >Gallery</a></li>    <li><a href="{{ route('contact') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Contact</a></li>
    
    @if(Auth::guard('customer')->check())
    <li><a href="{{ route('customer.history') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">My Bookings</a></li>
    @endif
  </ul>
  <div class="flex gap-5 items-center">
    <a href="https://www.instagram.com/twentytwo.salon/" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
    <a href="https://www.facebook.com/profile.php?id=61562223720806" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
    
    @if(Auth::guard('customer')->check())
        <form method="POST" action="{{ route('customer.logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors bg-transparent border-none cursor-pointer p-0">
                Sign Out
            </button>
        </form>
    @else
        <a href="{{ route('customer.login') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Sign In</a>
    @endif
    
    <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-sm font-semibold tracking-wider uppercase px-5 py-3 transition-colors">Book Now</a>
  </div>
</nav>

{{-- Header --}}
<section class="py-24 px-12 bg-white text-center">
    <p class="text-sm font-bold uppercase tracking-[0.4em] text-yellow-600 mb-4">Portfolio</p>
    <h1 class="text-6xl font-black uppercase tracking-tighter text-black">The Gallery</h1>
</section>



{{-- Grid --}}
<section class="px-4 md:px-12 pb-32">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
        @forelse ($galleryImages as $image)
        <div class="gallery-item group">
            <img src="{{ asset($image) }}" class="gallery-img" alt="Salon TwentyTwo gallery work {{ $loop->iteration }}">
            <div class="gallery-overlay">
                <div>
                    <p class="text-yellow-500 text-xs font-bold uppercase tracking-widest">Technique</p>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest">Salon Finish</h4>
                </div>
            </div>
        </div>
        @empty
        <div class="gallery-item group">
            <img src="{{ asset('images/hero.jpg') }}" class="gallery-img" alt="Salon TwentyTwo gallery work">
            <div class="gallery-overlay">
                <div>
                    <p class="text-yellow-500 text-xs font-bold uppercase tracking-widest">Technique</p>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest">Salon Finish</h4>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

@endsection
