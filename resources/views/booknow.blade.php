@extends('layouts.app')

@section('content')

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
    <a href="#" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
    <a href="#" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
    <a href="#" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Sign In</a>
  </div>
</nav>

{{-- Hero Section --}}
<section style="position:relative; height:45vh; background:#000; overflow:hidden; display:flex; align-items:center; justify-content:center; text-align:center;">
    <img src="{{ asset('images/services.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.4;"
         alt="Booking Background">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.7));"></div>
    <div style="position:relative; z-index:10; padding:0 24px;">
        <p style="font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.4em; color:#eab308; margin-bottom:16px;">Master Artistry Since 2024</p>
        <h1 style="font-size:clamp(56px,8vw,96px); font-weight:900; color:#fff; letter-spacing:-0.04em; line-height:1; margin:0;">Booking</h1>
    </div>
</section>

{{-- Main Section --}}
<section style="background:#fafaf9; padding:64px 48px;">
    <div style="max-width:1400px; margin:0 auto;">
        @if(session('success'))
            <div style="background:#ecfdf5; color:#047857; border:1px solid #a7f3d0; padding:16px 20px; margin-bottom:24px; font-size:14px; font-weight:700;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fef2f2; color:#b91c1c; border:1px solid #fecaca; padding:16px 20px; margin-bottom:24px; font-size:14px; font-weight:700;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('appointments.store') }}" style="display:grid; grid-template-columns:180px 1fr 340px; gap:32px; align-items:start;">
            @csrf

            {{-- 1. LEFT: Categories --}}
            <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="padding:20px; background:#fafaf9; border-bottom:1px solid #f3f4f6;">
                    <span style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Category</span>
                </div>
                <button type="button" onclick="showBookingCategory('promos', this)"
                        style="width:100%; text-align:left; padding:20px; font-size:13px; font-weight:800; letter-spacing:0.08em; text-transform:uppercase; border:none; border-bottom:1px solid #f3f4f6; background:#111; color:#fff; cursor:pointer;"
                        class="category-btn active">Salon Promos</button>
                <button type="button" onclick="showBookingCategory('hair', this)"
                        style="width:100%; text-align:left; padding:20px; font-size:13px; font-weight:800; letter-spacing:0.08em; text-transform:uppercase; border:none; border-bottom:1px solid #f3f4f6; background:#fff; color:#000; cursor:pointer;"
                        class="category-btn">Signature Cut</button>
                <button type="button" onclick="showBookingCategory('colour', this)"
                        style="width:100%; text-align:left; padding:20px; font-size:13px; font-weight:800; letter-spacing:0.08em; text-transform:uppercase; border:none; border-bottom:1px solid #f3f4f6; background:#fff; color:#000; cursor:pointer;"
                        class="category-btn">Signature Colour</button>
                <button type="button" onclick="showBookingCategory('special', this)"
                        style="width:100%; text-align:left; padding:20px; font-size:13px; font-weight:800; letter-spacing:0.08em; text-transform:uppercase; border:none; background:#fff; color:#000; cursor:pointer;"
                        class="category-btn">Special Services</button>
            </div>

            {{-- 2. MIDDLE: Services & Providers --}}
            <div style="display:flex; flex-direction:column; gap:40px;">

                {{-- Service Selection --}}
                <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                    <div style="padding:24px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
                        <h3 style="font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.12em; margin:0;" id="category-title">Salon Promos</h3>
                        <span style="font-size:12px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.12em; font-style:italic;">Select a treatment</span>
                    </div>

                    @foreach($serviceGroups as $group => $services)
                    <div id="booking-{{ $group }}" class="booking-list" style="{{ $group === 'promos' ? '' : 'display:none;' }}">
                        @forelse($services as $service)
                        <label style="display:flex; justify-content:space-between; align-items:flex-start; padding:30px; border-bottom:1px solid #f3f4f6; cursor:pointer; transition:background 0.2s;"
                               onmouseover="this.style.background='#fafaf9'" onmouseout="this.style.background='#fff'">
                            <div style="flex:1; padding-right:24px;">
                                <h4 style="font-size:16px; font-weight:900; text-transform:uppercase; margin:0 0 6px; letter-spacing:-0.01em;">{{ $service->service_name }}</h4>
                                <p style="font-size:14px; color:#9ca3af; font-weight:300; line-height:1.6; margin:0 0 12px;">{{ $service->description ?? 'Professional salon service tailored for you.' }}</p>
                                <span style="font-size:12px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.12em;">90 min</span>
                            </div>
                            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px;">
                                <span style="font-size:16px; font-weight:900;">&#8369;{{ number_format($service->price, 0) }}</span>
                                <input type="radio" name="service_id" value="{{ $service->id }}" @checked(old('service_id') == $service->id)
                                       style="width:24px; height:24px; appearance:none; border:1px solid #d1d5db; border-radius:50%; cursor:pointer; position:relative; flex-shrink:0;">
                            </div>
                        </label>
                        @empty
                        <div style="padding:30px; color:#9ca3af; font-size:14px;">
                            No services found in this tab.
                        </div>
                        @endforelse
                    </div>
                    @endforeach

                    <div style="padding:16px; background:rgba(250,250,249,0.5); display:flex; justify-content:flex-end;">
                        <button type="button" style="background:#000; color:#fff; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; padding:12px 24px; border:none; cursor:pointer; transition:background 0.2s;">
                            + Add Another Service
                        </button>
                    </div>
                </div>

                {{-- Provider Selection --}}
                <div>
                    <h3 style="font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:0.2em; margin-bottom:16px; color:#9ca3af;">Select a Service Provider</h3>
                    <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,0.06); overflow:hidden;">
                        <label style="display:flex; justify-content:space-between; align-items:center; padding:20px; border-bottom:1px solid #f3f4f6; cursor:pointer; transition:background 0.2s;"
                               onmouseover="this.style.background='#fafaf9'" onmouseout="this.style.background='#fff'">
                            <span style="font-size:14px; font-weight:900; text-transform:uppercase;">Any Service Provider</span>
                            <div style="display:flex; align-items:center; gap:16px;">
                                <span style="font-size:14px; color:#9ca3af;">Auto assign</span>
                                <input type="radio" name="stylist_id" value="{{ optional($stylists->first())->id }}" @checked(!old('stylist_id')) @disabled($stylists->isEmpty())
                                       style="width:24px; height:24px; appearance:none; border:1px solid #d1d5db; border-radius:50%; cursor:pointer; flex-shrink:0;">
                            </div>
                        </label>

                        <div style="display:grid; grid-template-columns:1fr 1fr;">
                            @foreach($stylists as $stylist)
                            <label style="display:flex; justify-content:space-between; align-items:center; padding:20px; border-bottom:1px solid #f3f4f6; border-right:1px solid #f3f4f6; cursor:pointer; transition:background 0.2s;"
                                   onmouseover="this.style.background='#fafaf9'" onmouseout="this.style.background='#fff'">
                                <span style="font-size:14px; font-weight:700; text-transform:uppercase;">{{ $stylist->name }}</span>
                                <div style="display:flex; align-items:center; gap:12px;">
                                    <span style="font-size:13px; color:#9ca3af; font-style:italic;">90m</span>
                                    <input type="radio" name="stylist_id" value="{{ $stylist->id }}" @checked(old('stylist_id') == $stylist->id)
                                           style="width:24px; height:24px; appearance:none; border:1px solid #d1d5db; border-radius:50%; cursor:pointer; flex-shrink:0;">
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. RIGHT: Details --}}
            <div style="display:flex; flex-direction:column; gap:24px;">
                <div style="background:#fff; border:1px solid #e5e7eb; padding:32px; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                    <div style="width:100%; height:192px; overflow:hidden; margin-bottom:32px;">
                        <img src="{{ asset('images/Frontsalon.jpg') }}"
                             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block; filter:grayscale(100%);"
                             alt="Salon">
                    </div>

                    <div style="display:flex; flex-direction:column; gap:32px;">
                        <div>
                            <p style="font-size:12px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:8px; border-bottom:1px solid #f3f4f6; padding-bottom:8px;">Opening Times</p>
                            <p style="font-size:15px; font-weight:500; margin:0;">Mon - Sun 10:00 AM - 10:00 PM</p>
                        </div>
                        <div>
                            <p style="font-size:12px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:8px; border-bottom:1px solid #f3f4f6; padding-bottom:8px;">Address</p>
                            <p style="font-size:15px; color:#6b7280; line-height:1.7; margin:0;">Main Branch, Pasig City,<br>Metro Manila, Philippines</p>
                        </div>
                        <div>
                            <p style="font-size:12px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:8px; border-bottom:1px solid #f3f4f6; padding-bottom:8px;">Policy</p>
                            <p style="font-size:13px; color:#9ca3af; line-height:1.7; font-style:italic; margin:0;">Cancellation requires 24h notice. Prices may vary based on hair length and density.</p>
                        </div>
                    </div>
                </div>

                <button type="submit" style="width:100%; background:#000; color:#fff; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:0.3em; padding:24px; border:none; cursor:pointer; transition:background 0.2s; box-shadow:0 10px 40px rgba(0,0,0,0.15);">
                    Continue to Details &rarr;
                </button>
            </div>

        </form>
    </div>
</section>

<style>
    .category-btn:hover { background:#fafaf9 !important; }
    .category-btn.active { background:#111 !important; color:#fff !important; }
    input[type="radio"]:checked { background:#111; border-color:#111; }
</style>

<script>
    function showBookingCategory(id, btn) {
        document.querySelectorAll('.category-btn').forEach(b => {
            b.classList.remove('active');
            b.style.background = '#fff';
            b.style.color = '#000';
        });
        document.querySelectorAll('.booking-list').forEach(list => {
            list.style.display = 'none';
        });

        btn.classList.add('active');
        btn.style.background = '#111';
        btn.style.color = '#fff';
        document.getElementById('category-title').textContent = btn.innerText;

        const activeList = document.getElementById('booking-' + id);
        activeList.style.display = 'block';

        const firstService = activeList.querySelector('input[name="service_id"]');
        if (firstService) {
            firstService.checked = true;
        }
    }
</script>

@endsection
