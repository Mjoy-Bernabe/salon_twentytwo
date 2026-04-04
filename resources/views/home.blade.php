@extends('layouts.app')

@section('content')

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100">
  <div class="text-sm font-bold tracking-widest uppercase">
    Salon<span class="text-yellow-600 font-light">TwentyTwo</span>  </div>
  <ul class="flex gap-10 list-none">
    <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">About</a></li>
    <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Services</a></li>
    <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Gallery</a></li>
    <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Find Us</a></li>
    <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Contact</a></li>
  </ul>
  <div class="flex gap-5 items-center">
    <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
    <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
    <a href="#" class="bg-black hover:bg-yellow-600 text-white text-xs font-semibold tracking-widest uppercase px-5 py-3 transition-colors">Book Now</a>
  </div>
</nav>

{{-- Hero --}}
<section class="relative h-screen bg-black overflow-hidden flex items-end">
<img src="{{ asset('images/hero.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
<img src="{{ asset('images/hero.jpg') }}" 
     class="w-full h-full object-cover absolute inset-0" 
     alt="Hero">
  <div class="absolute inset-0 bg-black/45"></div>
  <div class="relative z-10 p-16 pb-20">
    <h1 class="text-6xl font-light text-white leading-tight max-w-2xl">
      Where every visit<br>becomes a <span class="font-bold text-yellow-500">moment.</span>
    </h1>
    <p class="text-gray-300 text-sm mt-5 mb-8 max-w-md leading-relaxed font-light">
      Premium hair and beauty services crafted with precision, care, and artistry — tailored for you.
    </p>
    <a href="#" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold tracking-widest uppercase px-9 py-4 transition-colors">
      Book an Appointment
    </a>
  </div>
</section>

{{-- About Strip --}}
<section class="bg-stone-50 py-24 px-12 text-center">
  <h2 class="text-3xl font-light text-black max-w-2xl mx-auto leading-relaxed mb-5">
    A <strong class="font-bold">premium experience</strong> from the moment you walk in.
  </h2>
  <p class="text-sm text-gray-400 max-w-lg mx-auto leading-loose">
    We believe beauty is personal. Our team of expert stylists are dedicated to bringing out the best version of you — every single visit.
  </p>
  <div class="flex justify-center gap-24 mt-16 pt-12 border-t border-yellow-100">
    <div>
      <div class="text-4xl font-bold text-yellow-600">500+</div>
      <div class="text-xs tracking-widest uppercase text-gray-400 mt-2">Happy Clients</div>
    </div>
    <div>
      <div class="text-4xl font-bold text-yellow-600">8+</div>
      <div class="text-xs tracking-widest uppercase text-gray-400 mt-2">Years of Experience</div>
    </div>
    <div>
      <div class="text-4xl font-bold text-yellow-600">20+</div>
      <div class="text-xs tracking-widest uppercase text-gray-400 mt-2">Services Offered</div>
    </div>
  </div>
</section>

{{-- Services Section --}}
<section class="grid grid-cols-2 min-h-[600px]">
  {{-- Replace div with <img> when ready --}}
  <div class="bg-neutral-900 flex items-center justify-center min-h-[500px]">
    <!-- <p class="text-xs tracking-widest uppercase text-yellow-600 opacity-40">Services image here</p> -->
    <img src="{{ asset('images/services.jpg') }}" class="w-full h-full object-cover">
  </div>
  <div class="flex flex-col justify-center px-16 py-20">
    <p class="text-xs font-semibold tracking-widest uppercase text-yellow-600 mb-5">Our Services</p>
    <h2 class="text-4xl font-bold text-black leading-snug mb-5">Expertly crafted beauty treatments.</h2>
    <p class="text-sm text-gray-400 leading-loose mb-8">
      From precision haircuts and vibrant color to luxurious facials and nail care — every service is delivered with skill and attention to detail.
    </p>
    <a href="#" class="inline-block border border-black text-black hover:bg-black hover:text-white text-xs font-semibold tracking-widest uppercase px-7 py-4 transition-all w-fit">
      View All Services
    </a>
  </div>
</section>

{{-- About Section --}}
<section class="grid grid-cols-2 min-h-[600px]">
  <div class="flex flex-col justify-center px-16 py-20">
    <p class="text-xs font-semibold tracking-widest uppercase text-yellow-600 mb-5">About Us</p>
    <h2 class="text-4xl font-bold text-black leading-snug mb-5">Passionate about the art of beauty.</h2>
    <p class="text-sm text-gray-400 leading-loose mb-8">
      With over 8 years of experience, our licensed stylists bring expertise and warmth to every appointment — in a space designed for comfort and elegance.
    </p>
    <a href="#" class="inline-block border border-black text-black hover:bg-black hover:text-white text-xs font-semibold tracking-widest uppercase px-7 py-4 transition-all w-fit">
      Learn More
    </a>
  </div>
  {{-- Replace div with <img> when ready --}}
  <div class="bg-neutral-900 flex items-center justify-center min-h-[500px]">
    <p class="text-xs tracking-widest uppercase text-yellow-600 opacity-40">About image here</p>
    {{-- <img src="{{ asset('images/about.jpg') }}" class="w-full h-full object-cover"> --}}
  </div>
</section>

{{-- CTA --}}
<section class="bg-black py-24 px-12 text-center">
  <p class="text-xs tracking-widest uppercase text-yellow-600 mb-5">Ready?</p>
  <h2 class="text-5xl font-bold text-white mb-4">Book your appointment today.</h2>
  <p class="text-sm text-gray-500 mb-10">Walk in looking good. Walk out feeling extraordinary.</p>
  <a href="#" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold tracking-widest uppercase px-10 py-4 transition-colors">
    Book Now
  </a>
</section>

{{-- Footer --}}
<footer class="bg-neutral-950 text-gray-600 px-12 py-12">
  <div class="flex justify-between items-start mb-10 pb-10 border-b border-neutral-800">
    <div class="text-sm font-bold tracking-widest uppercase text-white">
        Salon<span class="text-yellow-600 font-light">TwentyTwo</span>  </div>
    </div>
    <div class="flex gap-16">
      <div>
        <h4 class="text-xs tracking-widest uppercase text-neutral-600 mb-4">Navigate</h4>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">About</a>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Services</a>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Gallery</a>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 transition-colors">Find Us</a>
      </div>
      <div>
        <h4 class="text-xs tracking-widest uppercase text-neutral-600 mb-4">Information</h4>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Contact Us</a>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Privacy Policy</a>
        <a href="#" class="block text-sm text-neutral-500 hover:text-yellow-600 transition-colors">Terms & Conditions</a>
      </div>
    </div>
  </div>
  <div class="flex justify-between items-center">
    <p class="text-xs text-neutral-700">© {{ date('Y') }} Salon Twenty Two. All rights reserved.</p>
    <div class="flex gap-6">
      <a href="#" class="text-xs tracking-widest uppercase text-neutral-600 hover:text-yellow-600 transition-colors">Facebook</a>
      <a href="#" class="text-xs tracking-widest uppercase text-neutral-600 hover:text-yellow-600 transition-colors">Instagram</a>
      <a href="#" class="text-xs tracking-widest uppercase text-neutral-600 hover:text-yellow-600 transition-colors">TikTok</a>
    </div>
  </div>
</footer>

@endsection