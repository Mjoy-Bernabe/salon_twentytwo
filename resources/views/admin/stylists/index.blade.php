@extends('admin.layouts.app')

@section('title', 'Stylists')

@section('content')
  <!-- Header -->
  <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-4xl font-bold text-white">Stylists</h1>
      <p class="mt-2 text-sm text-[#B0B0B0]">Manage stylists, their services, and schedules.</p>
    </div>
    <a href="{{ route('admin.stylists.create') }}" class="btn-accent inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Stylist
    </a>
  </div>

  @include('admin.partials.alerts')

  <!-- Table -->
  <div class="card rounded-xl overflow-hidden">
    <table class="w-full text-sm text-[#B0B0B0]">
      <thead class="bg-[#1A1A1A] border-b border-[#2A2A2A]">
        <tr>
          <th class="px-6 py-4 text-left font-semibold text-white">Name</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Services</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Schedules</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-[#2A2A2A]">
        @forelse($stylists as $stylist)
          <tr class="hover:bg-[#1A1A1A] transition">
            <td class="px-6 py-4 text-white font-medium">{{ $stylist->name }}</td>
            <td class="px-6 py-4 text-sm">{{ $stylist->services->pluck('service_name')->join(', ') }}</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center justify-center w-8 h-8 bg-[#CA8A04] bg-opacity-20 text-[#CA8A04] text-xs font-semibold rounded-full">
                {{ $stylist->schedules->count() }}
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.stylists.edit', $stylist) }}" title="Edit" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#0A0A0A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                
                <!-- Schedule -->
                <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" title="Manage Schedule" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#0A0A0A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </a>
                
                <!-- Delete -->
                <form action="{{ route('admin.stylists.destroy', $stylist) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
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
            <td colspan="4" class="px-6 py-12 text-center text-[#B0B0B0]">
              <svg class="mx-auto h-12 w-12 text-[#2A2A2A] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.856-1.488M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a3 3 0 003-3v-2a3 3 0 00-3-3H3a3 3 0 00-3 3v2a3 3 0 003 3h3z" />
              </svg>
              <p>No stylists found</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="bg-[#1A1A1A] border-t border-[#2A2A2A] px-6 py-4">
      {{ $stylists->links() }}
    </div>
  </div>
@endsection
