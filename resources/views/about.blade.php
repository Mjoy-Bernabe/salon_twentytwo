@extends('layouts.app')

@section('content')

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100 sticky top-0 z-50">
  <a href="{{ route('home') }}" class="text-base font-bold tracking-widest uppercase no-underline text-black">
    Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
  </a>
  
  <ul class="flex gap-10 list-none m-0 p-0">
    <li> 
        <a href="{{ route('about') }}" 
           class="text-sm tracking-wider uppercase no-underline transition-all pb-1 
           {{ Route::is('about') ? 'text-yellow-600 font-bold border-b-2 border-yellow-600' : 'text-gray-500 font-medium hover:text-yellow-600' }}">
           About
        </a>
    </li>
    <li>
        <a href="{{ route('services.index') }}" 
           class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline pb-1">
           Services
        </a>
    </li>
    <li>
        <a href="{{ route('gallery') }}" 
           class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline pb-1">
           Gallery
        </a>
    </li>
    <li>
        <a href="{{ route('contact') }}" 
           class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline pb-1">
           Contact
        </a>
    </li>
  </ul>

  <div class="flex gap-5 items-center">
    <a href="#" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors no-underline">Instagram</a>
    <a href="#" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors no-underline">Facebook</a>
    <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-sm font-bold tracking-wider uppercase px-6 py-3 transition-colors no-underline">Book Now</a>
  </div>
</nav>

{{-- Editorial Hero --}}
<section style="position:relative; background:#fff; overflow:hidden;">
    <div style="display:grid; grid-template-columns:1fr 1fr; min-height:70vh;">
        <div style="display:flex; flex-direction:column; justify-content:center; padding:96px; background:#fafaf9; order:1;">
            <p style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.4em; color:#d97706; margin-bottom:24px;">Established 2024</p>
            <h1 style="font-size:clamp(48px,6vw,72px); font-weight:900; color:#000; text-transform:uppercase; letter-spacing:-0.04em; line-height:0.9; margin-bottom:32px;">
                The Art of<br>Personal
                <span style="color:#d97706; font-weight:300; font-style:italic; display:block;">Beauty.</span>
            </h1>
            <div style="width:48px; height:2px; background:#d97706; margin-bottom:32px;"></div>
            <p style="color:#6b7280; font-size:16px; line-height:1.9; max-width:420px; margin:0;">
                Located in the heart of Pasig, SalonTwentyTwo was founded on a simple belief: that beauty is an individual journey. We don't follow trends — we create silhouettes that define who you are.
            </p>
        </div>
        <div style="position:relative; overflow:hidden; min-height:500px; order:2;">
            <img src="{{ asset('images/hero.jpg') }}"
                 style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; filter:grayscale(100%); transition:filter 1s ease;"
                 alt="Salon Interior"
                 onmouseover="this.style.filter='grayscale(0%)'"
                 onmouseout="this.style.filter='grayscale(100%)'">
            <div style="position:absolute; bottom:0; left:0; right:0; height:33%; background:linear-gradient(to top, rgba(0,0,0,0.4), transparent); pointer-events:none;"></div>
        </div>
    </div>
</section>

{{-- Three Pillars --}}
<section style="padding:112px 48px; background:#fff; border-bottom:1px solid #f3f4f6;">
    <div style="max-width:960px; margin:0 auto;">
        <p style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.4em; color:#d97706; margin-bottom:16px; text-align:center;">Our Principles</p>
        <h2 style="font-size:32px; font-weight:900; text-transform:uppercase; letter-spacing:-0.02em; text-align:center; margin-bottom:80px; color:#000;">What We Stand For</h2>
        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:48px;">
            <div style="text-align:center;">
                <span style="font-size:48px; font-weight:300; color:#d97706; margin-bottom:24px; display:block;">01</span>
                <h4 style="font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; margin-bottom:16px; color:#000;">Craftsmanship</h4>
                <div style="width:32px; height:2px; background:#d97706; margin:0 auto 24px;"></div>
                <p style="color:#9ca3af; font-size:15px; line-height:1.7; max-width:240px; margin:0 auto;">Every cut and colour is engineered with technical precision and artistic intuition, never rushed.</p>
            </div>
            <div style="text-align:center;">
                <span style="font-size:48px; font-weight:300; color:#d97706; margin-bottom:24px; display:block;">02</span>
                <h4 style="font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; margin-bottom:16px; color:#000;">Integrity</h4>
                <div style="width:32px; height:2px; background:#d97706; margin:0 auto 24px;"></div>
                <p style="color:#9ca3af; font-size:15px; line-height:1.7; max-width:240px; margin:0 auto;">We use only premium, organic-base products to ensure the long-term health and vitality of your hair.</p>
            </div>
            <div style="text-align:center;">
                <span style="font-size:48px; font-weight:300; color:#d97706; margin-bottom:24px; display:block;">03</span>
                <h4 style="font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; margin-bottom:16px; color:#000;">Experience</h4>
                <div style="width:32px; height:2px; background:#d97706; margin:0 auto 24px;"></div>
                <p style="color:#9ca3af; font-size:15px; line-height:1.7; max-width:240px; margin:0 auto;">From the first consultation to the final finish, your comfort and confidence are our primary focus.</p>
            </div>
        </div>
    </div>
</section>

{{-- The Creative Team --}}
<section style="padding:112px 48px; background:#fafaf9;">
    <div style="max-width:1280px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:80px; gap:24px; flex-wrap:wrap;">
            <div>
                <p style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.3em; color:#d97706; margin-bottom:16px;">Expertise</p>
                <h2 style="font-size:36px; font-weight:900; text-transform:uppercase; letter-spacing:-0.02em; margin:0; color:#000;">Meet the Stylists</h2>
            </div>
            <p style="color:#9ca3af; font-size:13px; text-transform:uppercase; letter-spacing:0.12em; margin:0;">Master Artistry Since 2024</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:4px;">
            {{-- Stylist 1 --}}
            <div style="position:relative; overflow:hidden; background:#000; height:500px;">
                <img src="{{ asset('images/hero.jpg') }}"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.8; transition:transform 0.7s, opacity 0.7s;"
                     alt="Hazel Jane"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.opacity='1'"
                     onmouseout="this.style.transform='scale(1)'; this.style.opacity='0.8'">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 40%, transparent 100%); pointer-events:none;"></div>
                <div style="position:absolute; bottom:0; left:0; padding:32px;">
                    <p style="color:#d97706; font-size:12px; text-transform:uppercase; font-weight:700; letter-spacing:0.12em; margin:0 0 6px;">Master Colourist</p>
                    <h5 style="color:#fff; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; font-size:20px; margin:0;">Hazel Jane</h5>
                </div>
            </div>

            {{-- Stylist 2 --}}
            <div style="position:relative; overflow:hidden; background:#000; height:500px;">
                <img src="{{ asset('images/services.jpg') }}"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.8; transition:transform 0.7s, opacity 0.7s;"
                     alt="Russel"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.opacity='1'"
                     onmouseout="this.style.transform='scale(1)'; this.style.opacity='0.8'">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 40%, transparent 100%); pointer-events:none;"></div>
                <div style="position:absolute; bottom:0; left:0; padding:32px;">
                    <p style="color:#d97706; font-size:12px; text-transform:uppercase; font-weight:700; letter-spacing:0.12em; margin:0 0 6px;">Senior Creative Director</p>
                    <h5 style="color:#fff; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; font-size:20px; margin:0;">Russel</h5>
                </div>
            </div>

            {{-- Stylist 3 --}}
            <div style="position:relative; overflow:hidden; background:#000; height:500px;">
                <img src="{{ asset('images/hero.jpg') }}"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.8; transition:transform 0.7s, opacity 0.7s;"
                     alt="Mara"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.opacity='1'"
                     onmouseout="this.style.transform='scale(1)'; this.style.opacity='0.8'">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 40%, transparent 100%); pointer-events:none;"></div>
                <div style="position:absolute; bottom:0; left:0; padding:32px;">
                    <p style="color:#d97706; font-size:12px; text-transform:uppercase; font-weight:700; letter-spacing:0.12em; margin:0 0 6px;">Cut Specialist</p>
                    <h5 style="color:#fff; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; font-size:20px; margin:0;">Mara</h5>
                </div>
            </div>

            {{-- Stylist 4 --}}
            <div style="position:relative; overflow:hidden; background:#000; height:500px;">
                <img src="{{ asset('images/services.jpg') }}"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.8; transition:transform 0.7s, opacity 0.7s;"
                     alt="Lena"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.opacity='1'"
                     onmouseout="this.style.transform='scale(1)'; this.style.opacity='0.8'">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 40%, transparent 100%); pointer-events:none;"></div>
                <div style="position:absolute; bottom:0; left:0; padding:32px;">
                    <p style="color:#d97706; font-size:12px; text-transform:uppercase; font-weight:700; letter-spacing:0.12em; margin:0 0 6px;">Texture Artist</p>
                    <h5 style="color:#fff; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; font-size:20px; margin:0;">Lena</h5>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Final CTA --}}
<section style="padding:128px 48px; background:#000; text-align:center;">
    <p style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.4em; color:#d97706; margin-bottom:24px;">Ready to Begin?</p>
    <h2 style="font-size:clamp(32px,4vw,48px); font-weight:300; color:#fff; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:16px;">
        Experience <span style="font-weight:900;">TwentyTwo</span>
    </h2>
    <div style="width:48px; height:2px; background:#d97706; margin:0 auto 48px;"></div>
    <a href="{{ route('booknow') }}" style="display:inline-block; border:1px solid #fff; color:#fff; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.3em; padding:20px 56px; text-decoration:none; transition:all 0.2s;">
        Book Your Session
    </a>
</section>

{{-- Footer --}}
<footer style="background:#0a0a0a; color:#4b5563; padding:64px 48px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:40px; margin-bottom:48px; padding-bottom:48px; border-bottom:1px solid #262626; flex-wrap:wrap;">
        <div>
            <div style="font-size:16px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#fff; margin-bottom:16px;">
                Salon<span style="color:#d97706; font-weight:300;">TwentyTwo</span>
            </div>
            <p style="color:#404040; font-size:14px; max-width:280px; line-height:1.7; margin:0;">Master artistry since 2024. Located in Pasig City, Metro Manila.</p>
        </div>
        <div style="display:flex; gap:64px;">
            <div>
                <h4 style="font-size:12px; letter-spacing:0.12em; text-transform:uppercase; color:#404040; margin-bottom:16px; font-weight:700;">Navigate</h4>
                <a href="{{ route('home') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none;">Home</a>
                <a href="{{ route('about') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none;">About</a>
                <a href="{{ route('services.index') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none;">Services</a>
            </div>
        </div>
    </div>
    <p style="font-size:13px; color:#262626; margin:0;">&copy; {{ date('Y') }} Salon Twenty Two. All rights reserved.</p>
</footer>

@endsection