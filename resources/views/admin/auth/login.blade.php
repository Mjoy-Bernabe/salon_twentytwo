@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-20">
  <div class="mx-auto w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200">
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
@endsection
