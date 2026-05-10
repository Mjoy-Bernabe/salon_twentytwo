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
    <a href="https://www.instagram.com/twentytwo.salon/" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
    <a href="https://www.facebook.com/profile.php?id=61562223720806" target="_blank" rel="noopener noreferrer" class="text-sm tracking-wider uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
    <a href="#" class="text-sm font-medium tracking-wider uppercase text-gray-500 hover:text-yellow-600 transition-colors">Sign In</a>
  </div>
</nav>

{{-- Hero Section --}}
<section style="position:relative; height:40vh; background:#000; overflow:hidden; display:flex; align-items:center; justify-content:center; text-align:center;">
    <img src="{{ asset('images/services.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; display:block; opacity:0.35;"
         alt="Booking Background">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.75) 100%);"></div>
    <div style="position:relative; z-index:10; padding:0 24px;">
        <p style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.5em; color:#eab308; margin-bottom:18px;">Master Artistry Since 2024</p>
        <h1 style="font-size:clamp(52px,7vw,88px); font-weight:900; color:#fff; letter-spacing:-0.04em; line-height:1; margin:0 0 16px;">Book Now</h1>
        <p style="font-size:13px; color:rgba(255,255,255,0.5); letter-spacing:0.2em; text-transform:uppercase; margin:0;">Complete the steps below to reserve your session</p>
    </div>
</section>

{{-- Step Progress Bar --}}
<div style="background:#fff; border-bottom:1px solid #f3f4f6; padding:0;">
    <div style="max-width:1400px; margin:0 auto; display:flex;">
        <div class="step-tab step-tab--active" id="step-tab-1" style="flex:1; display:flex; align-items:center; gap:12px; padding:20px 32px; border-right:1px solid #f3f4f6; cursor:default;">
            <div class="step-num" style="width:28px; height:28px; border-radius:50%; background:#111; color:#fff; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0;">1</div>
            <div>
                <div style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:2px;">Step 1</div>
                <div style="font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:0.05em;">Choose Service</div>
            </div>
        </div>
        <div class="step-tab" id="step-tab-2" style="flex:1; display:flex; align-items:center; gap:12px; padding:20px 32px; border-right:1px solid #f3f4f6; cursor:default; opacity:0.4;">
            <div class="step-num" style="width:28px; height:28px; border-radius:50%; background:#d1d5db; color:#fff; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0;">2</div>
            <div>
                <div style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:2px;">Step 2</div>
                <div style="font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:0.05em; color:#9ca3af;">Choose Stylist</div>
            </div>
        </div>
        <div class="step-tab" id="step-tab-3" style="flex:1; display:flex; align-items:center; gap:12px; padding:20px 32px; cursor:default; opacity:0.4;">
            <div class="step-num" style="width:28px; height:28px; border-radius:50%; background:#d1d5db; color:#fff; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0;">3</div>
            <div>
                <div style="font-size:10px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#9ca3af; margin-bottom:2px;">Step 3</div>
                <div style="font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:0.05em; color:#9ca3af;">Date & Time</div>
            </div>
        </div>
        {{-- Yellow accent bar --}}
        <div style="position:relative; flex:1; display:flex; align-items:center; gap:12px; padding:20px 32px; border-left:1px solid #f3f4f6;">
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#eab308;"></div>
            <div style="font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#9ca3af; flex:1;">
                <span id="summary-preview" style="color:#111; font-size:13px;">No service selected</span>
            </div>
        </div>
    </div>
</div>

{{-- Main Section --}}
<section style="background:#fafaf9; padding:48px;">
    <div style="max-width:1400px; margin:0 auto;">

        @if(session('success'))
            <div style="background:#ecfdf5; color:#047857; border:1px solid #a7f3d0; border-left:4px solid #059669; padding:16px 20px; margin-bottom:32px; font-size:14px; font-weight:700; display:flex; align-items:center; gap:12px;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#059669"/><path d="M8 12l3 3 5-5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fef2f2; color:#b91c1c; border:1px solid #fecaca; border-left:4px solid #dc2626; padding:16px 20px; margin-bottom:32px; font-size:14px; font-weight:700; display:flex; align-items:center; gap:12px;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#dc2626"/><path d="M12 8v4m0 4h.01" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('appointments.store') }}" style="display:grid; grid-template-columns:200px 1fr 360px; gap:28px; align-items:start;">
            @csrf

            @php
                $categoryTitles = [
                    'promos'  => 'Salon Promos',
                    'hair'    => 'Signature Cut',
                    'colour'  => 'Signature Colour',
                    'special' => 'Special Services',
                ];
                $categoryIcons = [
                    'promos'  => '✦',
                    'hair'    => '✂',
                    'colour'  => '◈',
                    'special' => '◇',
                ];
            @endphp

            {{-- ─── LEFT: Category Sidebar ─── --}}
            <div style="position:sticky; top:24px;">
                <div style="background:#fff; border:1px solid #e5e7eb; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                    <div style="padding:16px 20px; background:#111;">
                        <span style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.2em; color:#9ca3af;">Category</span>
                    </div>
                    @foreach($categoryTitles as $key => $label)
                    @if(isset($serviceGroups[$key]) && $serviceGroups[$key]->isNotEmpty())
                    <button type="button" onclick="showBookingCategory('{{ $key }}', this)"
                            data-category="{{ $key }}"
                            class="category-btn{{ $defaultGroup === $key ? ' active' : '' }}"
                            style="width:100%; text-align:left; padding:0; border:none; border-bottom:1px solid #f3f4f6; background:{{ $defaultGroup === $key ? '#111' : '#fff' }}; color:{{ $defaultGroup === $key ? '#fff' : '#111' }}; cursor:pointer; transition:all 0.15s;">
                        <div style="display:flex; align-items:center; gap:12px; padding:18px 20px;">
                            <span style="font-size:16px; opacity:0.6; flex-shrink:0;">{{ $categoryIcons[$key] }}</span>
                            <span style="font-size:12px; font-weight:800; letter-spacing:0.1em; text-transform:uppercase; line-height:1.3;">{{ $label }}</span>
                        </div>
                    </button>
                    @endif
                    @endforeach
                </div>

                {{-- Legend --}}
                <div style="margin-top:20px; padding:16px; background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                    <p style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0 0 12px;">Calendar Legend</p>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="width:14px; height:14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:2px; flex-shrink:0;"></span>
                            <span style="font-size:11px; color:#6b7280;">Available</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="width:14px; height:14px; background:#111; border-radius:2px; flex-shrink:0;"></span>
                            <span style="font-size:11px; color:#6b7280;">Selected</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="width:14px; height:14px; background:#fef3c7; border:1px solid #fde68a; border-radius:2px; flex-shrink:0;"></span>
                            <span style="font-size:11px; color:#6b7280;">Today</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="width:14px; height:14px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:2px; flex-shrink:0;"></span>
                            <span style="font-size:11px; color:#6b7280;">Unavailable</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── MIDDLE: Services + Stylist + Calendar ─── --}}
            <div style="display:flex; flex-direction:column; gap:28px;">

                {{-- Service Selection --}}
                <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden;">
                    <div style="padding:20px 28px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center; background:#fafaf9;">
                        <h3 id="category-title" style="font-size:12px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0;">{{ $categoryTitles[$defaultGroup] }}</h3>
                        <span style="font-size:11px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.15em;">Select a treatment</span>
                    </div>

                    @foreach($serviceGroups as $group => $services)
                    <div id="booking-{{ $group }}" class="booking-list" style="{{ $group === $defaultGroup ? '' : 'display:none;' }}">
                        @forelse($services as $service)
                        <label class="service-row" style="display:flex; justify-content:space-between; align-items:center; padding:22px 28px; border-bottom:1px solid #f8f9fa; cursor:pointer; transition:background 0.15s; gap:24px;">
                            <input type="radio" name="service_id" value="{{ $service->id }}" @checked(old('service_id') == $service->id)
                                   class="service-radio" style="display:none;">
                            <div class="service-indicator" style="width:4px; height:40px; background:#e5e7eb; border-radius:2px; flex-shrink:0; transition:background 0.15s;"></div>
                            <div style="flex:1; min-width:0;">
                                <h4 style="font-size:14px; font-weight:900; text-transform:uppercase; margin:0 0 4px; letter-spacing:0.02em;">{{ $service->service_name }}</h4>
                                <p style="font-size:13px; color:#9ca3af; font-weight:400; line-height:1.5; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $service->description ?? 'Professional salon service tailored for you.' }}</p>
                            </div>
                            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:6px; flex-shrink:0;">
                                <span style="font-size:17px; font-weight:900; letter-spacing:-0.02em;">&#8369;{{ number_format($service->price, 0) }}</span>
                                <span style="font-size:10px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.15em;">90 min</span>
                            </div>
                            <div class="radio-dot" style="width:20px; height:20px; border-radius:50%; border:2px solid #d1d5db; flex-shrink:0; display:flex; align-items:center; justify-content:center; transition:all 0.15s;">
                                <div style="width:8px; height:8px; border-radius:50%; background:#111; opacity:0; transition:opacity 0.15s;" class="radio-dot-inner"></div>
                            </div>
                        </label>
                        @empty
                        <div style="padding:40px; color:#9ca3af; font-size:14px; text-align:center;">
                            No services found in this category.
                        </div>
                        @endforelse
                    </div>
                    @endforeach
                </div>

                {{-- Provider Selection --}}
                <div id="provider-section">
                    <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
                        <div style="width:28px; height:28px; border-radius:50%; background:#111; color:#fff; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0;">2</div>
                        <h3 style="font-size:12px; font-weight:900; text-transform:uppercase; letter-spacing:0.2em; margin:0; color:#111;">Choose Your Stylist</h3>
                    </div>
                    <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden;">
                        <div id="stylists-grid" style="display:grid; grid-template-columns:1fr 1fr;">
                            <div style="grid-column:1/-1; padding:40px; color:#9ca3af; font-size:13px; text-align:center; letter-spacing:0.05em;">
                                ← Select a service to view available stylists
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Schedule Selection --}}
                <div id="schedule-selection" style="display:none;">
                    <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
                        <div style="width:28px; height:28px; border-radius:50%; background:#111; color:#fff; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0;">3</div>
                        <h3 style="font-size:12px; font-weight:900; text-transform:uppercase; letter-spacing:0.2em; margin:0; color:#111;">Select Date & Time</h3>
                    </div>
                    <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden;">
                        {{-- Calendar Header --}}
                        <div style="padding:18px 24px; background:#fafaf9; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
                            <button type="button" id="prev-month" style="background:#fff; border:1px solid #e5e7eb; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; color:#374151; transition:all 0.15s; border-radius:2px;">&larr;</button>
                            <h4 id="calendar-title" style="font-size:14px; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; margin:0;">Loading…</h4>
                            <button type="button" id="next-month" style="background:#fff; border:1px solid #e5e7eb; width:34px; height:34px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; color:#374151; transition:all 0.15s; border-radius:2px;">&rarr;</button>
                        </div>

                        {{-- Calendar Grid --}}
                        <div id="calendar-grid" style="display:grid; grid-template-columns:repeat(7,1fr); padding:20px; gap:6px;">
                            <!-- Populated by JS -->
                        </div>

                        {{-- Time Selection --}}
                        <div id="time-selection" style="display:none; border-top:2px solid #f3f4f6;">
                            <div style="padding:24px 24px 28px; background:#fff;">
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke="#eab308" stroke-width="2"/><path d="M12 7v5l3 3" stroke="#eab308" stroke-width="2" stroke-linecap="round"/></svg>
                                    <h4 id="selected-date-title" style="font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.1em; margin:0; color:#374151;"></h4>
                                </div>
                                <p style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.1em; margin:0 0 12px;">Select a time slot</p>
                                <select id="time-slots-grid" name="appointment_time_display"
                                    style="width:100%; padding:12px 16px; font-size:13px; font-weight:700; border:1px solid #e5e7eb; background:#fff; color:#374151; cursor:pointer; appearance:none; background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%23374151%22 d=%22M6 8L1 3h10z%22/></svg>'); background-repeat:no-repeat; background-position:right 14px center; letter-spacing:0.05em;">
                                    <option value="">-- Choose a time --</option>
                                </select>
                                <input type="hidden" name="appointment_datetime" id="appointment-datetime">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ─── RIGHT: Summary Sidebar ─── --}}
            <div style="display:flex; flex-direction:column; gap:20px; position:sticky; top:24px;">

                {{-- Salon Image + Info --}}
                <div style="background:#fff; border:1px solid #e5e7eb; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                    <div style="height:176px; overflow:hidden; position:relative;">
                        <img src="{{ asset('images/Frontsalon.jpg') }}"
                             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block; filter:grayscale(100%);"
                             alt="Salon">
                        <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.4), transparent);"></div>
                    </div>
                    <div style="display:flex; flex-direction:column;">
                        <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6;">
                            <p style="font-size:10px; font-weight:800; letter-spacing:0.18em; text-transform:uppercase; color:#eab308; margin:0 0 6px;">Opening Hours</p>
                            <p style="font-size:14px; font-weight:600; margin:0; color:#111;">Mon – Sun &nbsp;10:00 AM – 10:00 PM</p>
                        </div>
                        <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6;">
                            <p style="font-size:10px; font-weight:800; letter-spacing:0.18em; text-transform:uppercase; color:#eab308; margin:0 0 6px;">Address</p>
                            <p style="font-size:13px; color:#6b7280; line-height:1.7; margin:0;">Main Branch, Pasig City,<br>Metro Manila, Philippines</p>
                        </div>
                        <div style="padding:20px 24px;">
                            <p style="font-size:10px; font-weight:800; letter-spacing:0.18em; text-transform:uppercase; color:#eab308; margin:0 0 6px;">Policy</p>
                            <p style="font-size:12px; color:#9ca3af; line-height:1.7; font-style:italic; margin:0;">Cancellation requires 24h notice. Prices may vary based on hair length and density.</p>
                        </div>
                    </div>
                </div>

                {{-- Booking Summary Card --}}
                <div style="background:#fff; border:1px solid #e5e7eb; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden;">
                    <div style="padding:16px 24px; background:#111; display:flex; align-items:center; gap:8px;">
                        <span style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.2em; color:#9ca3af;">Your Booking Summary</span>
                    </div>
                    <div style="padding:20px 24px; display:flex; flex-direction:column; gap:16px;">
                        <div>
                            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0 0 4px;">Service</p>
                            <p id="summary-service" style="font-size:14px; font-weight:800; color:#111; margin:0;">—</p>
                        </div>
                        <div>
                            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0 0 4px;">Stylist</p>
                            <p id="summary-stylist" style="font-size:14px; font-weight:800; color:#111; margin:0;">—</p>
                        </div>
                        <div>
                            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0 0 4px;">Date & Time</p>
                            <p id="summary-datetime" style="font-size:14px; font-weight:800; color:#111; margin:0;">—</p>
                        </div>
                        <div style="border-top:1px solid #f3f4f6; padding-top:16px; display:flex; justify-content:space-between; align-items:center;">
                            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0;">Total</p>
                            <p id="summary-price" style="font-size:22px; font-weight:900; color:#111; margin:0; letter-spacing:-0.02em;">—</p>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; margin:0;">Downpayment Due (50%)</p>
                            <p id="summary-downpayment" style="font-size:18px; font-weight:900; color:#eab308; margin:0; letter-spacing:-0.02em;">—</p>
                        </div>
                    </div>
                </div>

                {{-- Hidden input to carry downpayment amount --}}
                <input type="hidden" name="downpayment_amount" id="downpayment-amount-input">

                <button type="button" id="open-payment-modal-btn"
                        onclick="openPaymentModal()"
                        style="width:100%; background:#111; color:#fff; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.3em; padding:22px; border:none; cursor:pointer; transition:all 0.2s; box-shadow:0 8px 32px rgba(0,0,0,0.18); position:relative; overflow:hidden;">
                    <span style="position:relative; z-index:1;">Book Appointment &rarr;</span>
                    <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#eab308;"></div>
                </button>

                <p style="text-align:center; font-size:11px; color:#d1d5db; text-transform:uppercase; letter-spacing:0.1em; margin:0;">
                    50% downpayment required to confirm
                </p>
            </div>
{{-- ── Payment Modal ── --}}
<div id="payment-modal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.6); backdrop-filter:blur(4px); align-items:center; justify-content:center;">
    <div style="background:#fff; width:100%; max-width:440px; margin:0 20px; box-shadow:0 32px 80px rgba(0,0,0,0.3); position:relative; overflow:hidden;">

        {{-- Modal header --}}
        <div style="background:#111; padding:24px 28px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <p style="font-size:10px; font-weight:800; letter-spacing:0.2em; text-transform:uppercase; color:#eab308; margin:0 0 4px;">Secure Checkout</p>
                <p style="font-size:16px; font-weight:900; color:#fff; margin:0; letter-spacing:-0.01em;">Downpayment (50%)</p>
            </div>
            <button type="button" onclick="closePaymentModal()" style="background:none; border:none; color:#9ca3af; font-size:22px; cursor:pointer; line-height:1; padding:4px;">&times;</button>
        </div>

        {{-- Amount display --}}
        <div style="background:#fafaf9; padding:20px 28px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af;">Amount Due</span>
            <span id="modal-amount" style="font-size:28px; font-weight:900; color:#111; letter-spacing:-0.03em;">—</span>
        </div>

        {{-- Card form --}}
        <div style="padding:28px;">
            <div style="display:flex; flex-direction:column; gap:16px;">

                {{-- Card number --}}
                <div>
                    <label style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; display:block; margin-bottom:6px;">Card Number</label>
                    <input id="mock-card-number" type="text" maxlength="19" placeholder="1234 5678 9012 3456"
                           oninput="formatCardNumber(this)"
                           style="width:100%; padding:12px 14px; border:1px solid #e5e7eb; font-size:15px; font-weight:600; letter-spacing:0.1em; color:#111; outline:none; box-sizing:border-box; transition:border 0.15s;"
                           onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e5e7eb'">
                </div>

                {{-- Name --}}
                <div>
                    <label style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; display:block; margin-bottom:6px;">Cardholder Name</label>
                    <input id="mock-card-name" type="text" placeholder="JUAN DELA CRUZ"
                           style="width:100%; padding:12px 14px; border:1px solid #e5e7eb; font-size:14px; font-weight:600; text-transform:uppercase; color:#111; outline:none; box-sizing:border-box; transition:border 0.15s;"
                           onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e5e7eb'">
                </div>

                {{-- Expiry + CVV --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; display:block; margin-bottom:6px;">Expiry</label>
                        <input id="mock-card-expiry" type="text" maxlength="5" placeholder="MM/YY"
                               oninput="formatExpiry(this)"
                               style="width:100%; padding:12px 14px; border:1px solid #e5e7eb; font-size:14px; font-weight:600; color:#111; outline:none; box-sizing:border-box; transition:border 0.15s;"
                               onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>
                    <div>
                        <label style="font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.15em; color:#9ca3af; display:block; margin-bottom:6px;">CVV</label>
                        <input id="mock-card-cvv" type="text" maxlength="3" placeholder="123"
                               style="width:100%; padding:12px 14px; border:1px solid #e5e7eb; font-size:14px; font-weight:600; color:#111; outline:none; box-sizing:border-box; transition:border 0.15s;"
                               onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>
                </div>

                {{-- Error message --}}
                <p id="payment-error" style="display:none; color:#dc2626; font-size:12px; font-weight:700; margin:0;"></p>

                {{-- Confirm button --}}
                <button type="button" onclick="confirmPayment()"
                        style="width:100%; background:#111; color:#fff; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.25em; padding:18px; border:none; cursor:pointer; margin-top:4px; position:relative; overflow:hidden; transition:background 0.2s;">
                    <span id="pay-btn-text">Confirm &amp; Pay &rarr;</span>
                    <div style="position:absolute; bottom:0; left:0; right:0; height:3px; background:#eab308;"></div>
                </button>


            </div>
        </div>
    </div>
</div>
        </form>
    </div>
</section>

<style>
    /* ── Category Buttons ── */
    .category-btn { display:block; }
    .category-btn:hover { background:#fafaf9 !important; color:#111 !important; }
    .category-btn.active { background:#111 !important; color:#fff !important; }
    .category-btn.active:hover { background:#222 !important; }

    /* ── Service Row ── */
    .service-row:hover { background:#fafaf9 !important; }
    .service-row:has(.service-radio:checked) { background:#fafaf9 !important; }
    .service-row:has(.service-radio:checked) .service-indicator { background:#111 !important; }
    .service-row:has(.service-radio:checked) .radio-dot { border-color:#111 !important; }
    .service-row:has(.service-radio:checked) .radio-dot-inner { opacity:1 !important; }

    /* ── Stylist Row ── */
    .stylist-label:hover { background:#fafaf9 !important; }
    .stylist-label:has(input:checked) { background:#fafaf9 !important; }
    .stylist-label:has(input:checked) .stylist-radio-dot { border-color:#111 !important; }
    .stylist-label:has(input:checked) .stylist-radio-dot-inner { opacity:1 !important; }
    .stylist-label:has(input:checked) .stylist-name { color:#111 !important; }

    /* ── Time Slot Buttons ── */
    .time-slot-btn {
        padding:10px 6px;
        font-size:12px;
        font-weight:700;
        border:1px solid #e5e7eb;
        background:#fff;
        cursor:pointer;
        transition:all 0.15s;
        text-align:center;
        letter-spacing:0.05em;
        color:#374151;
    }
    .time-slot-btn:hover { border-color:#111; background:#fafaf9; }
    .time-slot-btn.selected { background:#111 !important; color:#fff !important; border-color:#111 !important; }

    /* ── Calendar days ── */
    .cal-day {
        min-height:52px;
        padding:8px 4px;
        text-align:center;
        border-radius:3px;
        transition:background 0.15s, color 0.15s;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        font-size:13px;
        font-weight:600;
        user-select:none;
    }
    .cal-day--header {
        font-size:10px;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:0.1em;
        color:#9ca3af;
        cursor:default;
        min-height:32px;
    }
    .cal-day--unavailable { background:#f9fafb; color:#d1d5db; cursor:not-allowed; }
    .cal-day--other-month { opacity:0.35; }
    .cal-day--other-month:not(.cal-day--available) { pointer-events:none; }    /* Available — lowest priority so selected/today can override */
    .cal-day--available { background:#f0fdf4; color:#14532d; cursor:pointer; }
    .cal-day--available:hover { background:#bbf7d0; }
    /* Today overrides available */
    .cal-day--today { background:#fef3c7; color:#92400e; font-weight:800; }
    .cal-day--today:hover { background:#fde68a; }
    /* Selected always wins — placed last, no !important needed */
    .cal-day--selected,
    .cal-day--selected:hover,
    .cal-day--selected.cal-day--today,
    .cal-day--selected.cal-day--today:hover {
        background:#111;
        color:#fff;
        cursor:pointer;
    }

    /* ── Step tabs ── */
    .step-tab--active .step-num { background:#111 !important; }
    .step-tab--active { opacity:1 !important; }

    /* ── Nav/month buttons hover ── */
    #prev-month:hover, #next-month:hover { background:#f3f4f6 !important; }

    /* ── Submit hover ── */
    button[type="submit"]:hover { background:#222 !important; transform:translateY(-1px); box-shadow:0 12px 40px rgba(0,0,0,0.22) !important; }
</style>

<script>
    // ── Booking data for summary ──
    const serviceData = {};
    @foreach($serviceGroups as $group => $services)
        @foreach($services as $service)
            serviceData[{{ $service->id }}] = {
                name: '{{ addslashes($service->service_name) }}',
                price: '{{ number_format($service->price, 0) }}'
            };
        @endforeach
    @endforeach

    // ── Summary updater ──
    function updateSummary() {
        const serviceRadio = document.querySelector('input[name="service_id"]:checked');
        const stylistRadio = document.querySelector('input[name="stylist_id"]:checked');
        const datetime     = document.getElementById('appointment-datetime').value;

        // Service
        if (serviceRadio && serviceData[serviceRadio.value]) {
            const svc      = serviceData[serviceRadio.value];
            const rawPrice = svc.price.replace(',', '');
            const dp       = Math.ceil(parseFloat(rawPrice) * 0.5);

            document.getElementById('summary-service').textContent      = svc.name;
            document.getElementById('summary-price').textContent        = '₱' + svc.price;
            document.getElementById('summary-downpayment').textContent  = '₱' + dp.toLocaleString();
            document.getElementById('summary-preview').textContent      = svc.name;
        } else {
            document.getElementById('summary-service').textContent      = '—';
            document.getElementById('summary-price').textContent        = '—';
            document.getElementById('summary-downpayment').textContent  = '—';
            document.getElementById('summary-preview').textContent      = 'No service selected';
        }

        // Stylist
        if (stylistRadio) {
            const stylistLabel = stylistRadio.closest('label');
            const name = stylistLabel ? stylistLabel.querySelector('.stylist-name')?.textContent.trim() : '—';
            document.getElementById('summary-stylist').textContent = name || '—';
        } else {
            document.getElementById('summary-stylist').textContent = '—';
        }

        // Datetime
        if (datetime) {
            const d = new Date(datetime);
            document.getElementById('summary-datetime').textContent =
                d.toLocaleDateString('en-US', { weekday:'short', month:'short', day:'numeric' }) + ' · ' +
                d.toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit' });
        } else {
            document.getElementById('summary-datetime').textContent = '—';
        }
    }

    // ── Category switching ──
    function showBookingCategory(id, btn) {
        document.querySelectorAll('.category-btn').forEach(b => {
            b.classList.remove('active');
            b.style.background = '#fff';
            b.style.color = '#111';
        });
        document.querySelectorAll('.booking-list').forEach(list => {
            list.style.display = 'none';
        });

        btn.classList.add('active');
        btn.style.background = '#111';
        btn.style.color = '#fff';

        const titles = {
            promos:  'Salon Promos',
            hair:    'Signature Cut',
            colour:  'Signature Colour',
            special: 'Special Services',
        };
        document.getElementById('category-title').textContent = titles[id] || btn.innerText;

        const activeList = document.getElementById('booking-' + id);
        activeList.style.display = 'block';

        // Auto-select first service in category
        const firstService = activeList.querySelector('input[name="service_id"]');
        if (firstService) {
            firstService.checked = true;
            firstService.dispatchEvent(new Event('change', { bubbles: true }));
            updateStylists(firstService.value);
        }
    }

    // ── Fetch stylists for service ──
    function updateStylists(serviceId) {
        if (!serviceId) return;

        fetch('{{ route("appointments.stylists") }}?service_id=' + serviceId, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(stylists => {
            const grid = document.getElementById('stylists-grid');
            grid.innerHTML = '';

            if (stylists.length === 0) {
                grid.innerHTML = '<div style="grid-column:1/-1; padding:36px; color:#9ca3af; font-size:13px; text-align:center;">No stylists available for this service.</div>';
                document.getElementById('schedule-selection').style.display = 'none';
                return;
            }

            stylists.forEach((stylist, i) => {
                const label = document.createElement('label');
                label.className = 'stylist-label';
                label.style.cssText = `
                    display:flex; align-items:center; gap:14px;
                    padding:18px 20px; border-bottom:1px solid #f3f4f6;
                    border-right:${i % 2 === 0 ? '1px solid #f3f4f6' : 'none'};
                    cursor:pointer; transition:background 0.15s;
                `;
                label.innerHTML = `
                    <div style="width:38px; height:38px; border-radius:50%; background:#f3f4f6; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:800; color:#374151; flex-shrink:0; text-transform:uppercase;">
                        ${stylist.name.charAt(0)}
                    </div>
                    <span class="stylist-name" style="font-size:13px; font-weight:800; text-transform:uppercase; flex:1; color:#6b7280; letter-spacing:0.05em;">${stylist.name}</span>
                    <div class="stylist-radio-dot" style="width:18px; height:18px; border-radius:50%; border:2px solid #d1d5db; flex-shrink:0; display:flex; align-items:center; justify-content:center; transition:all 0.15s;">
                        <div class="stylist-radio-dot-inner" style="width:7px; height:7px; border-radius:50%; background:#111; opacity:${i === 0 ? 1 : 0}; transition:opacity 0.15s;"></div>
                    </div>
                    <input type="radio" name="stylist_id" value="${stylist.id}" ${i === 0 ? 'checked' : ''} style="display:none;">
                `;
                grid.appendChild(label);
            });

            document.getElementById('schedule-selection').style.display = 'block';
            activateStepTab(3);
            updateSchedules(stylists[0].id);
            updateSummary();
        })
        .catch(err => console.error('Stylists error:', err));
    }

    // ── Step tab activation ──
    function activateStepTab(step) {
        for (let i = 1; i <= 3; i++) {
            const tab = document.getElementById('step-tab-' + i);
            if (!tab) continue;
            if (i <= step) {
                tab.style.opacity = '1';
                const num = tab.querySelector('.step-num');
                if (num) num.style.background = '#111';
            }
        }
    }

    // ── Calendar state ──
    let currentStylistId = null;
    let currentMonth     = new Date().getMonth() + 1;
    let currentYear      = new Date().getFullYear();
    let selectedDate     = null;

    function updateSchedules(stylistId) {
        if (!stylistId) {
            document.getElementById('schedule-selection').style.display = 'none';
            return;
        }
        currentStylistId = stylistId;
        selectedDate     = null;
        document.getElementById('time-selection').style.display = 'none';
        document.getElementById('appointment-datetime').value   = '';
        loadCalendar();
    }

    function loadCalendar() {
        document.getElementById('calendar-title').textContent = 'Loading…';
        fetch(`{{ route("appointments.schedules") }}?stylist_id=${currentStylistId}&month=${currentMonth}&year=${currentYear}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => renderCalendar(data))
        .catch(err => console.error('Calendar error:', err));
    }

    function renderCalendar(data) {
        const grid  = document.getElementById('calendar-grid');
        const title = document.getElementById('calendar-title');
        title.textContent = data.monthName + ' ' + data.year;
        grid.innerHTML    = '';

        // Store calendar data on the grid for the click handler
        grid._calendarData = {};

        // Day headers
        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].forEach(d => {
            const el = document.createElement('div');
            el.className   = 'cal-day cal-day--header';
            el.textContent = d;
            grid.appendChild(el);
        });

        // Days
        data.calendar.forEach(day => {
            const el = document.createElement('div');
            el.className = 'cal-day';

            if (!day.isCurrentMonth) {
                el.classList.add('cal-day--other-month');
            }

            if (day.isAvailable) {
                el.classList.add('cal-day--available');
                if (day.isToday) el.classList.add('cal-day--today');
                // Store day data on the element itself
                el.dataset.date      = day.date;
                el.dataset.available = '1';
                // Store bookedTimes as JSON on the element
                el.dataset.bookedTimes  = JSON.stringify(day.bookedTimes || []);
                el.dataset.workingStart = day.workingHours ? day.workingHours.start : '';
                el.dataset.workingEnd   = day.workingHours ? day.workingHours.end   : '';
            } else {
                el.classList.add('cal-day--unavailable');
                if (day.isToday) el.classList.add('cal-day--today');
            }

            el.innerHTML = `<span>${day.day}</span>`;
            grid.appendChild(el);
        });
    }

    // Single delegated click handler on the calendar grid
    document.getElementById('calendar-grid').addEventListener('click', function(e) {
        const el = e.target.closest('.cal-day--available');
        if (!el) return;

        // Deselect previous
        document.querySelectorAll('#calendar-grid .cal-day--selected').forEach(d => {
            d.classList.remove('cal-day--selected');
        });
        el.classList.add('cal-day--selected');

        selectedDate = el.dataset.date;
        const formatted = new Date(el.dataset.date + 'T00:00:00').toLocaleDateString('en-US', {
            weekday:'long', year:'numeric', month:'long', day:'numeric'
        });
        document.getElementById('selected-date-title').textContent = formatted;

        const bookedTimes   = JSON.parse(el.dataset.bookedTimes  || '[]');
        const workingStart  = el.dataset.workingStart || '09:00';
        const workingEnd    = el.dataset.workingEnd   || '18:00';
        buildTimeSlots(bookedTimes, workingStart, workingEnd);
    });
    
    function buildTimeSlots(bookedTimes, workingStart, workingEnd) {
    const select = document.getElementById('time-slots-grid');
    select.innerHTML = '<option value="">-- Choose a time --</option>';

    let cur = new Date('2000-01-01T' + (workingStart || '09:00'));
    const end = new Date('2000-01-01T' + (workingEnd  || '18:00'));
    let hasSlots = false;

    while (cur < end) {
        const timeStr = cur.toTimeString().slice(0, 5);
        const booked  = isTimeSlotBooked(bookedTimes, timeStr);

        if (!booked) {
            const option = document.createElement('option');
            option.value       = timeStr;
            option.textContent = formatTime(timeStr);
            select.appendChild(option);
            hasSlots = true;
        }
        cur.setMinutes(cur.getMinutes() + 30);
    }

    if (!hasSlots) {
        const option = document.createElement('option');
        option.disabled    = true;
        option.textContent = 'No available slots for this day';
        select.appendChild(option);
    }

    document.getElementById('time-selection').style.display = 'block';
    document.getElementById('appointment-datetime').value   = '';
    updateSummary();
    }

    document.addEventListener('change', function(e) {
    if (e.target.id === 'time-slots-grid') {
        const timeStr = e.target.value;
        if (selectedDate && timeStr) {
            document.getElementById('appointment-datetime').value = selectedDate + ' ' + timeStr + ':00';
        } else {
            document.getElementById('appointment-datetime').value = '';
        }
        updateSummary();
    }
    });

    function formatTime(timeStr) {
        const [h, m] = timeStr.split(':').map(Number);
        const ampm   = h >= 12 ? 'PM' : 'AM';
        const hr     = h % 12 || 12;
        return `${hr}:${m.toString().padStart(2, '0')} ${ampm}`;
    }

    function isTimeSlotBooked(bookedTimes, timeStr) {
        const sel    = new Date('2000-01-01T' + timeStr);
        const selEnd = new Date(sel.getTime() + 90 * 60000);
        for (const b of bookedTimes) {
            const bStart = new Date('2000-01-01T' + b.start);
            const bEnd   = new Date('2000-01-01T' + b.end);
            if (sel < bEnd && selEnd > bStart) return true;
        }
        return false;
    }

    // ── Month navigation ──
    document.getElementById('prev-month').addEventListener('click', () => {
        if (--currentMonth < 1) { currentMonth = 12; currentYear--; }
        loadCalendar();
    });
    document.getElementById('next-month').addEventListener('click', () => {
        if (++currentMonth > 12) { currentMonth = 1; currentYear++; }
        loadCalendar();
    });

    // ── Global change handlers ──
    document.addEventListener('change', function(e) {
        if (e.target.name === 'service_id') {
            updateStylists(e.target.value);
            activateStepTab(2);
            updateSummary();
        }
        if (e.target.name === 'stylist_id') {
            updateSchedules(e.target.value);
            updateSummary();
        }
    });

    // ── Init ──
(function init() {
    const checkedService = document.querySelector('input[name="service_id"]:checked');
    if (checkedService) {
        updateStylists(checkedService.value);
        activateStepTab(2);
    } else {
        const firstService = document.querySelector('input[name="service_id"]');
        if (firstService) {
            firstService.checked = true;
            updateStylists(firstService.value);
            activateStepTab(2);
        }
    }
    updateSummary();
})();

// ── Payment Modal ──
let currentDownpayment = 0;

function openPaymentModal() {
    const service  = document.querySelector('input[name="service_id"]:checked');
    const stylist  = document.querySelector('input[name="stylist_id"]:checked');
    const datetime = document.getElementById('appointment-datetime').value;

    if (!service) { alert('Please select a service.'); return; }
    if (!stylist) { alert('Please select a stylist.'); return; }
    if (!datetime) { alert('Please select a date and time.'); return; }

    const priceRaw = serviceData[service.value]?.price?.replace(',', '') || '0';
    currentDownpayment = Math.ceil(parseFloat(priceRaw) * 0.5);

    document.getElementById('modal-amount').textContent = '₱' + currentDownpayment.toLocaleString();
    document.getElementById('payment-error').style.display = 'none';
    document.getElementById('mock-card-number').value = '';
    document.getElementById('mock-card-name').value   = '';
    document.getElementById('mock-card-expiry').value = '';
    document.getElementById('mock-card-cvv').value    = '';

    const modal = document.getElementById('payment-modal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closePaymentModal() {
    document.getElementById('payment-modal').style.display = 'none';
    document.body.style.overflow = '';
}

function formatCardNumber(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 16);
    input.value = v.match(/.{1,4}/g)?.join(' ') || v;
}

function formatExpiry(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 4);
    if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
    input.value = v;
}

function confirmPayment() {
    const cardNum  = document.getElementById('mock-card-number').value.replace(/\s/g, '');
    const cardName = document.getElementById('mock-card-name').value.trim();
    const expiry   = document.getElementById('mock-card-expiry').value;
    const cvv      = document.getElementById('mock-card-cvv').value;
    const errEl    = document.getElementById('payment-error');

    // Basic validation
    if (cardNum.length !== 16) {
        errEl.textContent = 'Please enter a valid 16-digit card number.';
        errEl.style.display = 'block'; return;
    }
    if (!cardName) {
        errEl.textContent = 'Please enter the cardholder name.';
        errEl.style.display = 'block'; return;
    }
    if (!/^\d{2}\/\d{2}$/.test(expiry)) {
        errEl.textContent = 'Please enter a valid expiry date (MM/YY).';
        errEl.style.display = 'block'; return;
    }
    if (cvv.length !== 3) {
        errEl.textContent = 'Please enter a valid 3-digit CVV.';
        errEl.style.display = 'block'; return;
    }

    errEl.style.display = 'none';

    // Simulate processing
    const btn = document.getElementById('pay-btn-text');
    btn.textContent = 'Processing…';

    setTimeout(() => {
        // Set downpayment value and submit the real form
        document.getElementById('downpayment-amount-input').value = currentDownpayment;
        closePaymentModal();
        document.querySelector('form').submit();
    }, 1500);
}

// Close modal on backdrop click
document.getElementById('payment-modal').addEventListener('click', function(e) {
    if (e.target === this) closePaymentModal();
});
</script>

@endsection
