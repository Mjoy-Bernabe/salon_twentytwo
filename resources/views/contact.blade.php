@extends('layouts.app')

@section('content')

<style>
    .contact-input { width: 100%; border: none; border-bottom: 1px solid #e5e7eb; padding: 15px 0; font-size: 15px; outline: none; transition: border-color 0.3s ease; background: transparent; }
    .contact-input:focus { border-bottom-color: #d97706; }
    .contact-label { font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; color: #9ca3af; display: block; margin-top: 20px; }
</style>

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100">
  <a href="{{ route('home') }}" class="text-base font-bold tracking-widest uppercase">
    Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
  </a>
  <ul class="flex gap-10 list-none">
    <li><a href="{{ route('about') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">About</a></li>
    <li><a href="{{ route('services.index') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Services</a></li>
    <li><a href="{{ route('gallery') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Gallery</a></li>
    <li><a href="{{ route('contact') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Contact</a></li>
  </ul>
  <div class="flex gap-5 items-center">
    <a href="https://www.instagram.com/twentytwo.salon/" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
    <a href="https://www.facebook.com/profile.php?id=61562223720806" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
    <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-sm font-semibold tracking-wider uppercase px-5 py-3 transition-colors">Book Now</a>
  </div>
</nav>

<section class="bg-stone-50 min-h-screen py-24 px-6 md:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
            
            {{-- Left: Text & Info --}}
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.4em] text-yellow-600 mb-6">Get in Touch</p>
                <h1 class="text-6xl font-black uppercase tracking-tighter text-black leading-none mb-12">Let's Talk <br>Artistry.</h1>
                
                <div class="space-y-12">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-widest mb-4">Location</h4>
                            <p class="text-base text-gray-500 leading-relaxed">Escentra Bldg Dr. Pilapil St.<br>Kapasigan, Pasig City</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-widest mb-4">Inquiries</h4>
                            <p class="text-base text-gray-500">hello@salontwentytwo.com<br>0924 132 1925</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-widest mb-4">Hours</h4>
                            <p class="text-base text-gray-500 leading-relaxed">10:00am - 8:00pm<br>Open everyday</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-12">
                        <h4 class="text-sm font-black uppercase tracking-widest mb-6">Follow Our Journey</h4>
                        <div class="flex gap-8">
                            <a href="https://www.instagram.com/twentytwo.salon/" target="_blank" rel="noopener noreferrer" class="text-base font-bold uppercase tracking-widest text-black no-underline hover:text-yellow-600">Instagram</a>
                            <a href="https://www.facebook.com/profile.php?id=61562223720806" target="_blank" rel="noopener noreferrer" class="text-base font-bold uppercase tracking-widest text-black no-underline hover:text-yellow-600">Facebook</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div class="bg-white p-12 md:p-16 shadow-2xl rounded-sm">
                @if (session('success'))
                    <div class="mb-8 border-l-4 border-yellow-600 bg-stone-50 px-5 py-4 text-sm font-bold uppercase tracking-widest text-black">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-8 border-l-4 border-red-600 bg-red-50 px-5 py-4 text-sm font-semibold text-red-800">
                        Please check the form and try again.
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div>
                        <label class="contact-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="contact-input" placeholder="Vince Russel">
                        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label class="contact-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="contact-input" placeholder="vince@example.com">
                            @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="contact-label">Subject</label>
                            <select name="subject" class="contact-input appearance-none cursor-pointer">
                                <option value="General Inquiry" @selected(old('subject') === 'General Inquiry')>General Inquiry</option>
                                <option value="Bridal/Events" @selected(old('subject') === 'Bridal/Events')>Bridal/Events</option>
                                <option value="Careers" @selected(old('subject') === 'Careers')>Careers</option>
                            </select>
                            @error('subject') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="contact-label">Your Message</label>
                        <textarea name="message" rows="4" class="contact-input resize-none" placeholder="How can we help you?">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-black text-white text-sm font-bold uppercase tracking-[0.3em] py-5 mt-12 hover:bg-yellow-600 transition-all shadow-xl">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
