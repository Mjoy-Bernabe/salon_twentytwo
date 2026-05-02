@extends('layouts.app')
@section('content')

{{-- Navbar --}}
<nav style="display:flex; justify-content:space-between; align-items:center; padding:20px 48px; background:#fff; border-bottom:1px solid #f3f4f6;">
  <a href="{{ route('home') }}" style="font-size:15px; font-weight:900; letter-spacing:0.15em; text-transform:uppercase; text-decoration:none; color:#111;">
    Salon<span style="color:#ca8a04; font-weight:300;">TwentyTwo</span>
  </a>
  <a href="{{ route('customer.login') }}"
     style="font-size:12px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; text-decoration:none;">
    Sign In
  </a>
</nav>

{{-- Hero --}}
<section style="position:relative; height:32vh; background:#000; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden;">
    <img src="{{ asset('images/services.jpg') }}"
         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0.3;">
    <div style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));"></div>
    <div style="position:relative; z-index:10;">
        <p style="font-size:11px; font-weight:700; letter-spacing:0.5em; text-transform:uppercase; color:#eab308; margin:0 0 12px;">Join Us Today</p>
        <h1 style="font-size:clamp(40px,6vw,72px); font-weight:900; color:#fff; letter-spacing:-0.03em; margin:0; line-height:1;">Create Account</h1>
    </div>
</section>

{{-- Form Section --}}
<section style="background:#fafaf9; min-height:65vh; display:flex; align-items:center; justify-content:center; padding:64px 24px;">
    <div style="width:100%; max-width:480px;">

        {{-- Card --}}
        <div style="background:#fff; border:1px solid #e5e7eb; padding:48px; box-shadow:0 4px 24px rgba(0,0,0,0.06);">

            <h2 style="font-size:13px; font-weight:900; letter-spacing:0.2em; text-transform:uppercase; margin:0 0 36px; padding-bottom:16px; border-bottom:1px solid #f3f4f6;">
                New Customer
            </h2>

            <form method="POST" action="{{ route('customer.register.post') }}">
                @csrf

                {{-- Name --}}
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Full Name
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           style="width:100%; padding:14px 16px; border:1px solid {{ $errors->has('name') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                           placeholder="Juan Dela Cruz">
                    @error('name')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           style="width:100%; padding:14px 16px; border:1px solid {{ $errors->has('email') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                           placeholder="your@email.com">
                    @error('email')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contact --}}
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Contact Number
                    </label>
                    <input type="text" name="contact_num" value="{{ old('contact_num') }}" required
                           style="width:100%; padding:14px 16px; border:1px solid {{ $errors->has('contact_num') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                           placeholder="09XXXXXXXXX"
                           maxlength="20">
                    @error('contact_num')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom:24px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Password
                    </label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="regPassword" required
                               style="width:100%; padding:14px 48px 14px 16px; border:1px solid {{ $errors->has('password') ? '#dc2626' : '#e5e7eb' }}; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box;"
                               onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                               onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                               placeholder="At least 6 characters">
                        <button type="button" onclick="togglePassword('regPassword', this)"
                                style="position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; font-size:12px; font-weight:700;">
                            SHOW
                        </button>
                    </div>
                    @error('password')
                    <p style="color:#dc2626; font-size:12px; margin:6px 0 0; font-weight:600;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div style="margin-bottom:36px;">
                    <label style="display:block; font-size:11px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:#6b7280; margin-bottom:8px;">
                        Confirm Password
                    </label>
                    <div style="position:relative;">
                        <input type="password" name="password_confirmation" id="regPasswordConfirm" required
                               style="width:100%; padding:14px 48px 14px 16px; border:1px solid #e5e7eb; background:#fafaf9; font-size:14px; color:#111; outline:none; box-sizing:border-box;"
                               onfocus="this.style.borderColor='#111'; this.style.background='#fff';"
                               onblur="this.style.borderColor='#e5e7eb'; this.style.background='#fafaf9';"
                               placeholder="Repeat your password">
                        <button type="button" onclick="togglePassword('regPasswordConfirm', this)"
                                style="position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#9ca3af; font-size:12px; font-weight:700;">
                            SHOW
                        </button>
                    </div>

                    {{-- Password match indicator --}}
                    <p id="matchMsg" style="font-size:12px; margin:6px 0 0; font-weight:600; display:none;"></p>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width:100%; background:#111; color:#fff; padding:16px; font-size:12px; font-weight:800; letter-spacing:0.25em; text-transform:uppercase; border:none; cursor:pointer; transition:background 0.2s;"
                        onmouseover="this.style.background='#ca8a04'"
                        onmouseout="this.style.background='#111'">
                    Create Account &rarr;
                </button>

            </form>
        </div>

        {{-- Login Link --}}
        <p style="text-align:center; margin-top:24px; font-size:13px; color:#9ca3af;">
            Already have an account?
            <a href="{{ route('customer.login') }}"
               style="color:#111; font-weight:800; text-decoration:none; border-bottom:1px solid #111;">
                Sign in here
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

// Live password match check
const pass = document.getElementById('regPassword');
const confirm = document.getElementById('regPasswordConfirm');
const msg = document.getElementById('matchMsg');

confirm.addEventListener('input', function () {
    if (confirm.value === '') {
        msg.style.display = 'none';
        return;
    }
    if (pass.value === confirm.value) {
        msg.style.display = 'block';
        msg.style.color = '#16a34a';
        msg.textContent = '✓ Passwords match';
        confirm.style.borderColor = '#16a34a';
    } else {
        msg.style.display = 'block';
        msg.style.color = '#dc2626';
        msg.textContent = '✗ Passwords do not match';
        confirm.style.borderColor = '#dc2626';
    }
});
</script>

@endsection