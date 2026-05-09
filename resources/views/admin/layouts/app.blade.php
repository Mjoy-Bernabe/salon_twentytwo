<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin') - {{ config('app.name', 'Salon') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
  <div class="flex min-h-screen">
    <aside class="w-72 border-r border-slate-200 bg-white px-5 py-6">
      <div class="mb-10">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold text-slate-900">Admin Panel</a>
      </div>

      <nav class="space-y-2 text-sm font-medium text-slate-700">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-4 py-3 hover:bg-slate-100 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 text-slate-900' : '' }}">Dashboard</a>
        <a href="{{ route('admin.services.index') }}" class="block rounded-lg px-4 py-3 hover:bg-slate-100 {{ request()->routeIs('admin.services.*') ? 'bg-slate-100 text-slate-900' : '' }}">Services</a>
        <a href="{{ route('admin.stylists.index') }}" class="block rounded-lg px-4 py-3 hover:bg-slate-100 {{ request()->routeIs('admin.stylists.*') ? 'bg-slate-100 text-slate-900' : '' }}">Stylists</a>
        <a href="{{ route('admin.customers.index') }}" class="block rounded-lg px-4 py-3 hover:bg-slate-100 {{ request()->routeIs('admin.customers.*') ? 'bg-slate-100 text-slate-900' : '' }}">Customers</a>
        <a href="{{ route('admin.appointments.index') }}" class="block rounded-lg px-4 py-3 hover:bg-slate-100 {{ request()->routeIs('admin.appointments.*') ? 'bg-slate-100 text-slate-900' : '' }}">Appointments</a>
      </nav>

      <div class="mt-12 border-t border-slate-200 pt-6">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-3 text-left text-white hover:bg-slate-700">Logout</button>
        </form>
      </div>
    </aside>

    <main class="flex-1 p-6 lg:p-10">
      <div class="mx-auto max-w-7xl">
        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
