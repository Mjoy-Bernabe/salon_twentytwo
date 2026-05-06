@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
  <!-- Header -->
  <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-4xl font-bold text-white">Services</h1>
      <p class="mt-2 text-sm text-[#B0B0B0]">Manage pricing, promos, and stylist availability.</p>
    </div>
    <a href="{{ route('admin.services.create', $tab === 'promo' ? ['tab' => 'promo'] : []) }}" class="btn-accent inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add {{ $tab === 'promo' ? 'Promo' : 'Service' }}
    </a>
  </div>

  @include('admin.partials.alerts')

  <!-- Tab Navigation -->
  <div class="mb-6 flex flex-wrap gap-3">
    <a href="?tab=all" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $tab === 'all' ? 'bg-[#CA8A04] text-[#000000]' : 'bg-[#1A1A1A] text-[#B0B0B0] hover:border-[#CA8A04] border border-[#2A2A2A]' }}">All</a>
    <a href="?tab=service" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $tab === 'service' ? 'bg-[#CA8A04] text-[#000000]' : 'bg-[#1A1A1A] text-[#B0B0B0] hover:border-[#CA8A04] border border-[#2A2A2A]' }}">Services</a>
    <a href="?tab=promo" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $tab === 'promo' ? 'bg-[#CA8A04] text-[#000000]' : 'bg-[#1A1A1A] text-[#B0B0B0] hover:border-[#CA8A04] border border-[#2A2A2A]' }}">Promos</a>
  </div>

  <!-- Table -->
  <div class="card rounded-xl overflow-hidden">
    <table class="w-full text-sm text-[#B0B0B0]">
      <thead class="bg-[#1A1A1A] border-b border-[#2A2A2A]">
        <tr>
          <th class="px-6 py-4 text-left font-semibold text-white">Name</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Price</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Promo</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Combo Items</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Stylists</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-[#2A2A2A]">
        @forelse($services as $service)
          <tr class="hover:bg-[#1A1A1A] transition">
            <td class="px-6 py-4 text-white font-medium">{{ $service->service_name }}</td>
            <td class="px-6 py-4 text-white">₱{{ number_format($service->price, 2) }}</td>
            <td class="px-6 py-4">
              @if($service->is_promo)
                <span class="inline-flex items-center gap-1 px-2 py-1 bg-[#CA8A04] bg-opacity-20 text-[#CA8A04] text-xs font-semibold rounded-full">✓ Yes</span>
              @else
                <span class="text-[#666666]">—</span>
              @endif
            </td>
            <td class="px-6 py-4 text-xs">{{ $service->is_promo ? $service->components->pluck('service_name')->join(', ') : '—' }}</td>
            <td class="px-6 py-4 text-xs">{{ $service->stylists->pluck('name')->join(', ') }}</td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.services.edit', $service) }}" title="Edit" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#0A0A0A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                
                <!-- Delete -->
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" title="Delete" class="p-2 text-[#B0B0B0] hover:text-red-400 hover:bg-[#0A0A0A] rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-6 py-12 text-center text-[#B0B0B0]">
              <svg class="mx-auto h-12 w-12 text-[#2A2A2A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.5a2 2 0 00-1 .267" />
              </svg>
              <p>No services found</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="bg-[#1A1A1A] border-t border-[#2A2A2A] px-6 py-4">
      {{ $services->links() }}
    </div>
  </div>

@endsection
