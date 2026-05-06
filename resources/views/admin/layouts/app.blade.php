<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin') - {{ config('app.name', 'Salon') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    :root {
      --color-primary-black: #000000;
      --color-accent-gold: #CA8A04;
      --color-dark-bg: #0A0A0A;
      --color-card-bg: #1A1A1A;
      --color-border: #2A2A2A;
      --color-text-primary: #FFFFFF;
      --color-text-secondary: #B0B0B0;
    }
    
    body {
      background-color: var(--color-dark-bg);
      color: var(--color-text-primary);
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .sidebar-nav a {
      position: relative;
      transition: all 0.3s ease;
    }
    
    .sidebar-nav a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 3px;
      background-color: var(--color-accent-gold);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .sidebar-nav a.active::before {
      opacity: 1;
    }
    
    .btn-primary {
      background-color: var(--color-primary-black);
      color: var(--color-text-primary);
      border: 1px solid var(--color-border);
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background-color: var(--color-primary-black);
      border-color: var(--color-accent-gold);
      box-shadow: 0 0 12px rgba(202, 138, 4, 0.2);
    }
    
    .btn-accent {
      background-color: var(--color-accent-gold);
      color: var(--color-primary-black);
      border: none;
      transition: all 0.3s ease;
    }
    
    .btn-accent:hover {
      background-color: #D49A0F;
      box-shadow: 0 4px 12px rgba(202, 138, 4, 0.3);
    }
    
    .card {
      background-color: var(--color-card-bg);
      border: 1px solid var(--color-border);
      transition: all 0.3s ease;
    }
    
    .card:hover {
      border-color: var(--color-accent-gold);
      box-shadow: 0 4px 16px rgba(202, 138, 4, 0.1);
    }
    
    .accent-border {
      border-color: var(--color-accent-gold) !important;
    }
    
    .accent-text {
      color: var(--color-accent-gold);
    }
  </style>
</head>
<body class="min-h-screen">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 border-r border-[#2A2A2A] bg-[#0A0A0A] px-6 py-8 flex flex-col">
      <!-- Logo & Brand -->
      <div class="mb-12">
        <a href="{{ route('admin.dashboard') }}" class="block">
          <div class="text-xl font-bold tracking-wide text-white mb-1">
            SALON
          </div>
          <div class="text-2xl font-black text-[#CA8A04] tracking-tighter">
            TWENTYTWO
          </div>
        </a>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 sidebar-nav space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium text-[#B0B0B0] hover:text-white rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'active text-white bg-[#1A1A1A]' : 'hover:bg-[#1A1A1A]' }}">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
          Dashboard
        </a>
        <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3 text-sm font-medium text-[#B0B0B0] hover:text-white rounded-lg transition {{ request()->routeIs('admin.services.*') ? 'active text-white bg-[#1A1A1A]' : 'hover:bg-[#1A1A1A]' }}">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15a23.931 23.931 0 00-9-1.977m18-3.438A21.046 21.046 0 0012 13c-7.052 0-13.058-1.765-18-4.732m0 0C3.942 8.991 6.588 8 12 8s8.058.991 12 2.838m-36 6.438h36m-3 1h3m-36 1h36m-24 1h24" />
          </svg>
          Services
        </a>
        <a href="{{ route('admin.stylists.index') }}" class="flex items-center px-4 py-3 text-sm font-medium text-[#B0B0B0] hover:text-white rounded-lg transition {{ request()->routeIs('admin.stylists.*') ? 'active text-white bg-[#1A1A1A]' : 'hover:bg-[#1A1A1A]' }}">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.856-1.488M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a3 3 0 003-3v-2a3 3 0 00-3-3H3a3 3 0 00-3 3v2a3 3 0 003 3h3z" />
          </svg>
          Stylists
        </a>
        <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium text-[#B0B0B0] hover:text-white rounded-lg transition {{ request()->routeIs('admin.customers.*') ? 'active text-white bg-[#1A1A1A]' : 'hover:bg-[#1A1A1A]' }}">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 8.048M12 4.354L8.117 8.427M12 4.354l3.883 4.073M3.172 15.172h17.656M9 20h6" />
          </svg>
          Customers
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="flex items-center px-4 py-3 text-sm font-medium text-[#B0B0B0] hover:text-white rounded-lg transition {{ request()->routeIs('admin.appointments.*') ? 'active text-white bg-[#1A1A1A]' : 'hover:bg-[#1A1A1A]' }}">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Appointments
        </a>
      </nav>

      <!-- Logout Button -->
      <div class="border-t border-[#2A2A2A] pt-6">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="w-full btn-primary px-4 py-3 text-sm font-medium rounded-lg hover:text-[#CA8A04]">
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
      <div class="p-8 lg:p-12">
        <div class="mx-auto max-w-7xl">
          @yield('content')
        </div>
      </div>
    </main>
  </div>
</body>
</html>
