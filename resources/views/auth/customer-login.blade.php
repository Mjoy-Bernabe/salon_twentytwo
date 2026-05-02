@extends('layouts.app')
@section('content')

{{-- Navbar --}}
<nav style="display:flex; justify-content:space-between; align-items:center; padding:20px 48px; background:#fff; border-bottom:1px solid #f3f4f6;">
  <a href="{{ route('home') }}" style="font-size:15px; font-weight:900; letter-spacing:0.15em; text-transform:uppercase; text-decoration:none; color:#111;">
    Salon<span style="color:#ca8a04; font-weight:300;">TwentyTwo</span>
  </a>
  <a href="{{ route('customer.register') }}"
     style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; text-decoration:none;">
    Create Account
  </a>
</nav>

{{-- Hero --}}
<section style="position:relative; height:32vh; background:#000; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden;">
    <img src="{{ asset('images/services.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0.3;">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));"></div>
    <div style="position:relative; z-index:10;">
        <p style="font-size:11px; font-weight:700; letter-spacing:0.5em; text-transform:uppercase; color:#eab308; margin:0 0 12px;">Welcome Back</p>
        <h1 style="font-size:clamp(40px,6vw,72px); font-weight:900; color:#fff; letter-spacing:-0.03em; margin:0; line-height:1;">Sign In</h1>
    </div>
</section>

{{-- Form Section --}}
<section style="background:#fafaf9; min-height:65vh; display:flex; align-items:center; justify-content:center; padding:64px 24px;">
    <div style="width:100%; max-width:480px;">

        {{-- Alerts --}}
        @if(session('success'))
        <div style="background:#16a34a; color:#fff; padding:14px 20px; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:28px;">
            ✓ &nbsp;{{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="background:#dc2626; color:#fff; padding:14px 20px; font-size:12px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:28px;">
            ✗ &nbsp;{{ session('error') }}
        </div>
        @endif

        {{-- Card --}}
        <div style="background:#fff; border:1px solid #e5e7eb; padding:48px; box-shadow:0 4px 24px rgba(0,0,0,0.06);">

            <h2 style="font-size:13px; font-weight:900; letter-spacing:0.2em; text-transform:uppercase; margin:0 0 36px; padding-bottom:16px; border-bottom:1px solid #f3f4f6;">
                Customer Login
            </h2>

            <form method="POST" action="{{ route('customer.login.post') }}">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           style="width:100%; padding:14px 16px; border:1px solid {{ $errors->has('email') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box; transition:border 0.2s;"
                           onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                           placeholder="your@email.com">
                    @error('email')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom:28px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Password
                    </label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="loginPassword" required
                               style="width:100%; padding:14px 48px 14px 16px; border:1px solid {{ $errors->has('password') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box; transition:border 0.2s;"
                               onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                               onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword('loginPassword', this)"
                                style="position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; font-size:12px; font-weight:700; letter-spacing:0.05em;">
                            SHOW
                        </button>
                    </div>
                    @error('password')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:32px;">
                    <input type="checkbox" name="remember" id="remember"
                           style="width:16px; height:16px; accent-color:#111; cursor:pointer;">
                    <label for="remember" style="font-size:13px; color:#6b7280; cursor:pointer;">Remember me</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width:100%; background:#111; color:#fff; padding:16px; font-size:12px; font-weight:800; letter-spacing:0.25em; text-transform:uppercase; border:none; cursor:pointer; transition:background 0.2s;"
                        onmouseover="this.style.background='#ca8a04'"
                        onmouseout="this.style.background='#111'">
                    Sign In &rarr;
                </button>

            </form>
        </div>

        {{-- Register Link --}}
        <p style="text-align:center; margin-top:24px; font-size:13px; color:#9ca3af;">
            Don't have an account?
            <a href="{{ route('customer.register') }}"
               style="color:#111; font-weight:800; text-decoration:none; border-bottom:1px solid #111;">
                Register here
            </a>
        </p>

    </div>
</section>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = 'HIDE';
    } else {
        input.type = 'password';
        btn.textContent = 'SHOW';
    }
}
</script>

@endsection