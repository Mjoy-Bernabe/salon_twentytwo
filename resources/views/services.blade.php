@extends('layouts.app')

@section('content')

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100 sticky top-0 z-50">
    <a href="{{ route('home') }}" class="text-base font-bold tracking-widest uppercase hover:opacity-80 transition-opacity no-underline text-black">
        Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
    </a>
    
    <ul class="flex gap-10 list-none m-0 p-0">
        <li>
            <a href="{{ route('about') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline">
                About
            </a>
        </li>
        
        <li>
            <a href="{{ route('services.index') }}" 
               class="text-sm tracking-wider uppercase no-underline transition-all pb-1 
               {{ Route::is('services.*') ? 'text-yellow-600 font-bold border-b-2 border-yellow-600' : 'text-gray-500 font-medium hover:text-yellow-600' }}">
                Services
            </a>
        </li>
        
        <li>
            <a href="{{ route('gallery') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline">
                Gallery
            </a>
        </li>
        
        <li>
            <a href="{{ route('contact') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline">
                Contact
            </a>
        </li>
        
        @if(Auth::guard('customer')->check())
        <li>
            <a href="{{ route('customer.history') }}" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors no-underline">
                My Bookings
            </a>
        </li>
        @endif
    </ul>

    <div class="flex gap-6 items-center">
        <a href="https://www.instagram.com/twentytwo.salon/" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors no-underline">Instagram</a>
        <a href="https://www.facebook.com/profile.php?id=61562223720806"
           target="_blank"
           class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">
            Facebook
        </a>
        @if(Auth::guard('customer')->check())
            <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm font-semibold tracking-wider uppercase text-gray-400 hover:text-black transition-colors bg-transparent border-none cursor-pointer p-0">
                    Sign Out
                </button>
            </form>
        @else
            <a href="{{ route('customer.login') }}" class="text-sm font-semibold tracking-wider uppercase text-gray-400 hover:text-black transition-colors no-underline">Sign In</a>
        @endif
        
        <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-sm font-bold tracking-wider uppercase px-6 py-3 transition-colors no-underline">Book Now</a>
    </div>
</nav>


{{-- Page Hero --}}
<section style="position:relative; height:60vh; background:#000; overflow:hidden; display:flex; align-items:center; justify-content:center; text-align:center;">
    <img src="{{ asset('images/full.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.4; filter:grayscale(20%);"
         alt="Our Services Background">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.3), rgba(0,0,0,0.7));"></div>
    <div style="position:relative; z-index:10; padding:0 24px;">
        <p style="font-size:14px; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:#eab308; margin-bottom:20px;">What We Offer</p>
        <h1 style="font-size:clamp(60px,8vw,96px); font-weight:900; color:#fff; letter-spacing:-0.04em; line-height:1; margin:0;">
            Our <span style="color:#eab308; font-weight:300; font-style:italic;">Services</span>
        </h1>
    </div>
</section>

{{-- Consultation Section --}}
<section style="display:grid; grid-template-columns:1fr 1fr; background:#fff;">
    <div style="height:600px; overflow:hidden;">
        <img src="{{ asset('images/Frontsalon.jpg') }}"
             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block; transition:transform 0.7s ease;"
             alt="Salon Consultation"
             onmouseover="this.style.transform='scale(1.05)'"
             onmouseout="this.style.transform='scale(1)'">
    </div>
    <div style="display:flex; flex-direction:column; justify-content:center; padding:80px;">
        <p style="font-size:13px; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:#d97706; margin-bottom:16px;">Start Here</p>
        <h2 style="font-size:36px; font-weight:900; text-transform:uppercase; letter-spacing:-0.02em; color:#000; margin-bottom:24px; line-height:1.1;">Complimentary<br>Consultation</h2>
        <div style="width:48px; height:2px; background:#d97706; margin-bottom:32px;"></div>
        <p style="font-size:16px; color:#6b7280; line-height:1.8; margin-bottom:40px; max-width:400px; font-weight:300;">
            Finding your perfect hairdresser is important. We recommend a complimentary consultation to talk through your needs with our experts before committing to any service.
        </p>
        <a href="{{ route('booknow') }}" style="background:#000; color:#fff; font-size:13px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; padding:16px 40px; text-decoration:none; display:inline-block; width:fit-content; transition:background 0.2s;">
            Book Now — It's Free
        </a>
    </div>
</section>

{{-- SECTION 01: THE SCULPTED CUT --}}
<div style="padding:112px 0; background:#fff;">
    <div style="padding:0 80px; margin-bottom:64px;">
        <div style="display:flex; align-items:flex-end; gap:0;">
            <span style="font-size:144px; font-weight:900; color:#f3f4f6; line-height:1; user-select:none;">01</span>
            <div style="margin-left:-40px; margin-bottom:16px;">
                <h3 style="font-size:clamp(28px,3vw,40px); font-weight:900; text-transform:uppercase; letter-spacing:0.08em; color:#000; margin:0;">The Sculpted Cut</h3>
                <p style="color:#d97706; font-size:13px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; margin-top:8px;">Precision &amp; Movement</p>
            </div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:5fr 7fr; align-items:center;">
        <div style="padding:0 0 0 80px; z-index:2;">
            <div style="background:#fafaf9; padding:64px; border:1px solid #f3f4f6;">
                <p style="color:#9ca3af; font-size:13px; margin-bottom:20px; letter-spacing:0.12em; text-transform:uppercase;">Signature Service</p>
                <h4 style="font-size:24px; font-weight:900; color:#000; text-transform:uppercase; margin-bottom:20px; letter-spacing:-0.02em;">Bespoke Silhouette</h4>
                <div style="width:32px; height:2px; background:#d97706; margin-bottom:28px;"></div>
                <p style="color:#6b7280; font-size:15px; line-height:1.9; margin-bottom:40px;">
                    We don't just cut hair — we engineer it. Our process begins with a structural analysis of your face profile, followed by dry-carving techniques that ensure your style holds its shape between visits.
                </p>
                <a href="{{ route('booknow') }}" style="display:inline-flex; align-items:center; gap:12px; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; text-decoration:none; color:#000; transition:color 0.2s;">
                    Reserve Your Session
                    <span style="display:block; width:32px; height:1px; background:#000;"></span>
                </a>
            </div>
        </div>
        <div style="height:700px; position:relative;">
            <img src="{{ asset('images/hero.jpg') }}"
                 style="width:100%; height:100%; object-fit:cover; object-position:center; display:block; filter:grayscale(100%); transition:filter 1s ease;"
                 alt="Master Cut"
                 onmouseover="this.style.filter='grayscale(0%)'"
                 onmouseout="this.style.filter='grayscale(100%)'">
            <div style="position:absolute; bottom:32px; right:0; background:#d97706; padding:16px 32px;">
                <p style="color:#000; font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; margin:0;">Master Cut</p>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 02: SIGNATURE COLOUR --}}
<div style="background:#171717; padding:128px 0; overflow:hidden;">
    <div style="max-width:1280px; margin:0 auto; padding:0 48px; display:grid; grid-template-columns:1fr 1fr; gap:96px; align-items:center;">
        <div style="position:relative;">
            <div style="aspect-ratio:4/5; background:#262626; position:relative; overflow:hidden;">
                <img src="{{ asset('images/signature.jpg') }}"
                     style="width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.75; transition:opacity 0.7s, transform 0.7s;"
                     alt="Signature Colour"
                     onmouseover="this.style.opacity='1'; this.style.transform='scale(1.05)'"
                     onmouseout="this.style.opacity='0.75'; this.style.transform='scale(1)'">
                <div style="position:absolute; inset:0; border:16px solid rgba(255,255,255,0.05); pointer-events:none;"></div>
            </div>
            <div style="position:absolute; bottom:-24px; right:-24px; background:#d97706; width:112px; height:112px; display:flex; align-items:center; justify-content:center; z-index:0;">
                <span style="color:#000; font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; text-align:center; line-height:1.4;">Colour<br>Art</span>
            </div>
        </div>
        <div style="color:#fff;">
            <span style="color:#eab308; font-size:13px; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; display:block; margin-bottom:24px;">02 — Artistry</span>
            <h3 style="font-size:48px; font-weight:900; text-transform:uppercase; margin:0; line-height:1;">Signature</h3>
            <h3 style="font-size:48px; font-weight:300; text-transform:uppercase; margin:0 0 32px; line-height:1; color:#737373; font-style:italic;">Global Tint</h3>
            <div style="width:48px; height:2px; background:#d97706; margin-bottom:32px;"></div>
            <p style="color:#737373; font-size:15px; line-height:1.9; margin-bottom:48px; max-width:400px;">
                Your colour is your signature. Find the one shade that truly illuminates your eyes through our professional Light-Reflect method — custom-blended in-house by our master colourists.
            </p>
            <div style="border-top:1px solid #262626; padding-top:32px;">
                <a href="{{ route('booknow') }}" style="display:flex; justify-content:space-between; align-items:center; text-decoration:none;">
                    <span style="font-size:13px; text-transform:uppercase; letter-spacing:0.12em; color:#fff;">Book a Colourist</span>
                    <div style="width:48px; height:48px; border-radius:50%; border:1px solid rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; transition:all 0.2s;">
                        <span style="color:#fff; font-size:18px; line-height:1;">&rarr;</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer style="background:#0a0a0a; color:#4b5563; padding:64px 48px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:48px; margin-bottom:48px; padding-bottom:48px; border-bottom:1px solid #262626; flex-wrap:wrap;">
        <div>
            <div style="font-size:16px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#fff; margin-bottom:16px;">
                Salon<span style="color:#d97706; font-weight:300;">TwentyTwo</span>
            </div>
            <p style="color:#404040; font-size:14px; max-width:280px; line-height:1.7;">Master artistry since 2024. Located in Pasig City, Metro Manila.</p>
        </div>
        <div style="display:flex; gap:64px;">
            <div>
                <h4 style="font-size:12px; letter-spacing:0.12em; text-transform:uppercase; color:#404040; margin-bottom:16px; font-weight:700;">Navigate</h4>
                <a href="{{ route('home') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none; transition:color 0.2s;">Home</a>
                <a href="{{ route('about') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none; transition:color 0.2s;">About</a>
                <a href="{{ route('services.index') }}" style="display:block; font-size:15px; color:#737373; margin-bottom:12px; text-decoration:none; transition:color 0.2s;">Services</a>
            </div>
            <div>
                <h4 style="font-size:12px; letter-spacing:0.12em; text-transform:uppercase; color:#404040; margin-bottom:16px; font-weight:700;">Visit</h4>
                <p style="font-size:15px; color:#737373; margin-bottom:8px;">Mon – Sun</p>
                <p style="font-size:15px; color:#737373;">10:00 AM – 10:00 PM</p>
            </div>
        </div>
    </div>
    <p style="font-size:13px; color:#262626;">&copy; {{ date('Y') }} Salon Twenty Two. All rights reserved.</p>
</footer>

@endsection
