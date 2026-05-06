@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-20">
  <div class="mx-auto w-full max-w-md">
    <!-- Tab Selector -->
    <div class="mb-6 flex gap-2 rounded-3xl bg-slate-200 p-2">
      <button id="tab-customer" onclick="switchTab('customer')" class="tab-btn flex-1 rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition">Customer Login</button>
      <button id="tab-admin" onclick="switchTab('admin')" class="tab-btn flex-1 rounded-2xl px-4 py-2 text-sm font-semibold text-slate-600 transition">Admin Login</button>
    </div>

    <!-- Customer Login Form -->
    <div id="form-customer" class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-200">
      <h1 class="mb-6 text-3xl font-semibold text-slate-900">Customer Login</h1>

      <form method="POST" action="{{ route('customer.login.post') }}" class="space-y-5">
        @csrf

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
          <input type="password" name="password" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
        </div>

        @if($errors->any())
          <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
            <p>{{ $errors->first() }}</p>
          </div>
        @endif

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-white hover:bg-slate-700">Sign In</button>
      </form>

      <p class="mt-4 text-center text-sm text-slate-600">
        Don't have an account? <a href="{{ route('customer.register') }}" class="font-semibold text-slate-900 hover:underline">Register here</a>
      </p>
    </div>

    <!-- Admin Login Form -->
    <div id="form-admin" class="hidden rounded-3xl bg-white p-8 shadow-xl shadow-slate-200">
      <h1 class="mb-6 text-3xl font-semibold text-slate-900">Admin Login</h1>

      <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
        @csrf

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
        </div>

        <div>
          <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
          <input type="password" name="password" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
        </div>

        @if($errors->any())
          <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
            <p>{{ $errors->first() }}</p>
          </div>
        @endif

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-white hover:bg-slate-700">Sign In</button>
      </form>
    </div>
  </div>
</div>

<script>
  function switchTab(tab) {
    // Hide all forms
    document.getElementById('form-customer').classList.add('hidden');
    document.getElementById('form-admin').classList.add('hidden');
    
    // Remove active styling from all tabs
    document.getElementById('tab-customer').classList.remove('bg-white', 'shadow-sm');
    document.getElementById('tab-customer').classList.add('bg-slate-200', 'text-slate-600');
    document.getElementById('tab-admin').classList.remove('bg-white', 'shadow-sm');
    document.getElementById('tab-admin').classList.add('bg-slate-200', 'text-slate-600');
    
    // Show selected form and highlight tab
    if (tab === 'customer') {
      document.getElementById('form-customer').classList.remove('hidden');
      document.getElementById('tab-customer').classList.remove('bg-slate-200', 'text-slate-600');
      document.getElementById('tab-customer').classList.add('bg-white', 'shadow-sm', 'text-slate-900');
    } else if (tab === 'admin') {
      document.getElementById('form-admin').classList.remove('hidden');
      document.getElementById('tab-admin').classList.remove('bg-slate-200', 'text-slate-600');
      document.getElementById('tab-admin').classList.add('bg-white', 'shadow-sm', 'text-slate-900');
    }
  }
</script>
@endsection
