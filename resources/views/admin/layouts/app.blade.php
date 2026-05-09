<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Admin') - {{ config('app.name', 'Salon') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell min-h-screen">
  <div class="flex min-h-screen">
    <aside class="w-72 border-r border-slate-800 bg-black px-5 py-6">
      <div class="mb-10">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand inline-block text-[1.5rem] leading-tight">
          <span class="brand-salon">SALON</span>
          <span class="brand-twentytwo block">TWENTYTWO</span>
        </a>
        <p class="mt-2 text-xs uppercase tracking-[0.2em] text-amber-600/90">Admin Console</p>
      </div>

      <nav class="space-y-2 text-sm font-medium text-slate-300">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.dashboard') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Dashboard</a>
        <a href="{{ route('admin.services.index') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.services.*') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Services</a>
        <a href="{{ route('admin.stylists.index') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.stylists.*') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Stylists</a>
        <a href="{{ route('admin.customers.index') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.customers.*') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Customers</a>
        <a href="{{ route('admin.appointments.index') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.appointments.*') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Appointments</a>
      </nav>

      <div class="mt-12 border-t border-slate-800 pt-6">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="w-full rounded-lg border border-amber-600/50 bg-black px-4 py-3 text-left text-amber-500 transition hover:bg-amber-600 hover:text-black">Logout</button>
        </form>
      </div>
    </aside>

    <main class="flex-1 bg-[#0a0a0a] p-6 lg:p-10">
      <div class="mx-auto max-w-7xl">
        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
