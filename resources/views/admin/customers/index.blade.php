@extends('admin.layouts.app')

@section('title', 'Customers')

@section('content')
  <!-- Header -->
  <div class="mb-8">
    <h1 class="text-4xl font-bold text-white">Customers</h1>
    <p class="mt-2 text-sm text-[#B0B0B0]">Manage customer accounts, filter status, and view appointment history.</p>
  </div>

  @include('admin.partials.alerts')

  <!-- Filter Bar -->
  <div class="mb-6">
    <form method="GET" action="{{ route('admin.customers.index') }}" class="flex items-center gap-4">
      <label for="active" class="text-sm font-medium text-[#B0B0B0]">Filter by Status:</label>
      <select name="active" id="active" onchange="this.form.submit()" class="bg-[#1A1A1A] border border-[#2A2A2A] text-white rounded-lg px-4 py-2 text-sm focus:border-[#CA8A04] focus:outline-none transition w-48">
        <option value="">All Customers</option>
        <option value="active" {{ request('active') === 'active' ? 'selected' : '' }}>✓ Active</option>
        <option value="inactive" {{ request('active') === 'inactive' ? 'selected' : '' }}>✕ Inactive</option>
      </select>
    </form>
  </div>

  <!-- Table -->
  <div class="card rounded-xl overflow-hidden">
    <table class="w-full text-sm text-[#B0B0B0]">
      <thead class="bg-[#1A1A1A] border-b border-[#2A2A2A]">
        <tr>
          <th class="px-6 py-4 text-left font-semibold text-white">Name</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Email</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Phone</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Status</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Appointments</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-[#2A2A2A]">
        @forelse($customers as $customer)
          <tr class="hover:bg-[#1A1A1A] transition">
            <td class="px-6 py-4 text-white font-medium">{{ $customer->name }}</td>
            <td class="px-6 py-4 text-white text-sm">{{ $customer->email }}</td>
            <td class="px-6 py-4">{{ $customer->contact_num ?? '—' }}</td>
            <td class="px-6 py-4">
              <form method="POST" action="{{ route('admin.customers.toggle-active', $customer) }}" class="inline">
                @csrf
                @method('PATCH')
                <label class="inline-flex items-center gap-2 cursor-pointer group">
                  <div class="relative">
                    <input type="checkbox" name="active" value="1" class="sr-only peer" {{ $customer->active ? 'checked' : '' }} onchange="this.form.submit()">
                    <div class="w-8 h-5 bg-[#2A2A2A] rounded-full peer-checked:bg-[#CA8A04] transition"></div>
                    <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full peer-checked:left-4 transition"></div>
                  </div>
                  <span class="text-xs font-semibold {{ $customer->active ? 'text-[#CA8A04]' : 'text-[#B0B0B0]' }}">
                    {{ $customer->active ? 'Active' : 'Inactive' }}
                  </span>
                </label>
              </form>
            </td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center justify-center w-6 h-6 bg-[#CA8A04] bg-opacity-20 text-[#CA8A04] text-xs font-semibold rounded-full">
                {{ $customer->appointments_count }}
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <!-- View -->
                <a href="{{ route('admin.customers.show', $customer) }}" title="View Details" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#1A1A1A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </a>
                
                <!-- Edit -->
                <a href="{{ route('admin.customers.edit', $customer) }}" title="Edit" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#1A1A1A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-6 py-12 text-center text-[#B0B0B0]">
              <svg class="mx-auto h-12 w-12 text-[#2A2A2A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 8.048M12 4.354L8.117 8.427M12 4.354l3.883 4.073M3.172 15.172h17.656M9 20h6" />
              </svg>
              <p>No customers found</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="bg-[#1A1A1A] border-t border-[#2A2A2A] px-6 py-4">
      {{ $customers->links() }}
    </div>
  </div>
@endsection
