@extends('layouts.app')
@section('content')

{{-- Navbar --}}
<nav style="display:flex; justify-content:space-between; align-items:center; padding:20px 48px; background:#fff; border-bottom:1px solid #f3f4f6;">
  <a href="{{ route('home') }}" style="font-size:15px; font-weight:900; letter-spacing:0.15em; text-transform:uppercase; text-decoration:none; color:#111;">
    Salon<span style="color:#ca8a04; font-weight:300;">TwentyTwo</span>
  </a>
  <div style="display:flex; gap:24px; align-items:center;">
    <span style="font-size:13px; color:#6b7280; text-transform:uppercase; letter-spacing:0.1em;">
        Hi, {{ $customer->name }}
    </span>
    <a href="{{ route('booking') }}"
       style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; text-decoration:none;">
        Book Again
    </a>
    <form method="POST" action="{{ route('customer.logout') }}" style="display:inline;">
        @csrf
        <button type="submit"
                style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; background:none; border:none; cursor:pointer;">
            Sign Out
        </button>
    </form>
  </div>
</nav>

{{-- Hero --}}
<section style="position:relative; height:32vh; background:#000; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden;">
    <img src="{{ asset('images/services.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0.3;">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));"></div>
    <div style="position:relative; z-index:10;">
        <p style="font-size:11px; font-weight:700; letter-spacing:0.5em; text-transform:uppercase; color:#eab308; margin:0 0 12px;">Your Journey</p>
        <h1 style="font-size:clamp(40px,6vw,72px); font-weight:900; color:#fff; letter-spacing:-0.03em; margin:0; line-height:1;">My Bookings</h1>
    </div>
</section>

{{-- Content --}}
<section style="background:#fafaf9; padding:64px 48px; min-height:60vh;">
    <div style="max-width:900px; margin:0 auto;">

        {{-- Success Message --}}
        @if(session('success'))
        <div style="background:#16a34a; color:#fff; padding:14px 20px; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:32px;">
            ✓ &nbsp;{{ session('success') }}
        </div>
        @endif

        {{-- Stats --}}
        @php
            $total     = $appointments->count();
            $pending   = $appointments->where('status','pending')->count();
            $confirmed = $appointments->where('status','confirmed')->count();
            $done      = $appointments->where('status','done')->count();
        @endphp
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:48px;">
            @foreach([
                ['Total',     '#111',     $total],
                ['Pending',   '#d97706',  $pending],
                ['Confirmed', '#2563eb',  $confirmed],
                ['Done',      '#16a34a',  $done],
            ] as [$label, $color, $count])
            <div style="background:#fff; border:1px solid #e5e7eb; padding:24px; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <div style="font-size:36px; font-weight:900; color:{{ $color }};">{{ $count }}</div>
                <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; color:#9ca3af; margin-top:6px;">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        {{-- Appointment Cards --}}
        @forelse($appointments as $appointment)
        @php
            $statusStyles = [
                'pending'   => ['bg' => '#fef3c7', 'color' => '#92400e'],
                'confirmed' => ['bg' => '#dbeafe', 'color' => '#1e40af'],
                'done'      => ['bg' => '#dcfce7', 'color' => '#166534'],
                'cancelled' => ['bg' => '#fee2e2', 'color' => '#991b1b'],
            ];
            $s = $statusStyles[$appointment->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151'];
        @endphp

        <div style="background:#fff; border:1px solid #e5e7eb; margin-bottom:16px; padding:28px 32px; display:flex; justify-content:space-between; align-items:flex-start; gap:24px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">

            {{-- Left --}}
            <div style="flex:1;">
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
                    <span style="font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; background:{{ $s['bg'] }}; color:{{ $s['color'] }}; padding:5px 14px;">
                        {{ strtoupper($appointment->status) }}
                    </span>
                    <span style="font-size:12px; color:#9ca3af;">
                        Booked on {{ $appointment->created_at->format('M d, Y') }}
                    </span>
                </div>

                <div style="font-size:18px; font-weight:900; color:#111; margin-bottom:8px; text-transform:uppercase; letter-spacing:-0.01em;">
                    {{ $appointment->services->pluck('service_name')->join(', ') ?: '—' }}
                </div>

                <div style="font-size:14px; color:#6b7280; margin-bottom:6px;">
                    Stylist: <strong style="color:#111;">{{ $appointment->stylist->name ?? 'Any' }}</strong>
                </div>

                <div style="font-size:13px; color:#9ca3af; letter-spacing:0.02em;">
                    {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F d, Y · h:i A') }}
                </div>
            </div>

            {{-- Right --}}
            <div style="text-align:right; flex-shrink:0;">
                <div style="font-size:26px; font-weight:900; color:#111;">
                    ₱{{ number_format($appointment->services->sum('price'), 0) }}
                </div>
                <div style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:0.12em; margin-top:4px;">
                    Total
                </div>
            </div>

        </div>
        @empty

        {{-- Empty State --}}
        <div style="text-align:center; padding:80px 24px;">
            <p style="font-size:14px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; color:#111; margin-bottom:8px;">
                No bookings yet
            </p>
            <p style="font-size:14px; color:#9ca3af; margin-bottom:32px;">
                You haven't made any appointments yet.
            </p>
            <a href="{{ route('booking') }}"
               style="background:#111; color:#fff; padding:14px 36px; font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.2em; text-decoration:none; display:inline-block;">
                Book Now &rarr;
            </a>
        </div>

        @endforelse

    </div>
</section>

@endsection