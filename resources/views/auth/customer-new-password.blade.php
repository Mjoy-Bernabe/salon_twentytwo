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
    <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-sm font-semibold tracking-wider uppercase px-5 py-3 transition-colors">Book Now</a>
  </div>
</nav>

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
  <div class="max-w-md w-full">
    <div class="bg-white rounded-lg shadow-md p-8">
      <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Create New Password</h2>

      @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-6">
          @foreach ($errors->all() as $error)
            <p class="text-sm">{{ $error }}</p>
          @endforeach
        </div>
      @endif

      @if (session('email'))
        <form method="POST" action="{{ route('customer.reset-password') }}">
          @csrf

          <input type="hidden" name="email" value="{{ session('email') }}">

          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="••••••"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent outline-none transition"
              required
              minlength="6"
            >
            <p class="text-xs text-gray-500 mt-1">Minimum 6 characters</p>
          </div>

          <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <input 
              type="password" 
              id="password_confirmation" 
              name="password_confirmation" 
              placeholder="••••••"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent outline-none transition"
              required
              minlength="6"
            >
          </div>

          <button 
            type="submit" 
            class="w-full bg-black hover:bg-yellow-600 text-white font-semibold py-2 rounded-lg transition-colors"
          >
            Reset Password
          </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
          <a href="{{ route('customer.login') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">Back to Sign In</a>
        </p>
      @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded text-sm">
          <p>Please verify your reset code first.</p>
          <a href="{{ route('customer.verify-reset-code') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">Go to Code Verification</a>
        </div>
      @endif
    </div>
  </div>
</div>

@endsection
