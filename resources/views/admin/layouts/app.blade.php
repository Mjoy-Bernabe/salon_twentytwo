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
        <a href="{{ route('admin.appointments.index') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.appointments.index', 'admin.appointments.create', 'admin.appointments.edit', 'admin.appointments.show') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Appointments</a>
        <a href="{{ route('admin.appointments.receipts') }}" class="block rounded-lg px-4 py-3 transition hover:bg-[#171717] hover:text-amber-500 {{ request()->routeIs('admin.appointments.receipts') ? 'bg-[#171717] text-amber-500 ring-1 ring-amber-600/40' : '' }}">Appointment History</a>
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

  <div id="admin-confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4">
    <div class="w-full max-w-md rounded-3xl border border-amber-600/40 bg-[#101010] p-6 shadow-2xl">
      <h3 id="admin-confirm-title" class="text-lg font-semibold text-amber-400">Confirm Action</h3>
      <p id="admin-confirm-message" class="mt-2 text-sm text-slate-300">Are you sure you want to continue?</p>
      <div class="mt-6 flex justify-end gap-3">
        <button id="admin-confirm-cancel" type="button" class="rounded-full border border-slate-600 bg-transparent px-4 py-2 text-sm font-medium text-slate-300 hover:bg-slate-800">Cancel</button>
        <button id="admin-confirm-accept" type="button" class="rounded-full border border-amber-500 bg-amber-500 px-4 py-2 text-sm font-semibold text-black hover:bg-amber-400">Confirm</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('admin-confirm-modal');
      const title = document.getElementById('admin-confirm-title');
      const message = document.getElementById('admin-confirm-message');
      const cancelBtn = document.getElementById('admin-confirm-cancel');
      const acceptBtn = document.getElementById('admin-confirm-accept');
      let pendingForm = null;

      const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        pendingForm = null;
      };

      document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (!form.matches('[data-confirm]')) return;
        if (form.dataset.confirmed === '1') return;

        event.preventDefault();
        pendingForm = form;
        title.textContent = form.dataset.confirmTitle || 'Confirm Action';
        message.textContent = form.dataset.confirmMessage || 'Are you sure you want to continue?';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      });

      cancelBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', (event) => {
        if (event.target === modal) closeModal();
      });
      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeModal();
      });

      acceptBtn.addEventListener('click', () => {
        if (!pendingForm) return closeModal();
        pendingForm.dataset.confirmed = '1';
        pendingForm.submit();
      });
    });
  </script>
</body>
</html>
