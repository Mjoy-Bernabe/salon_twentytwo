@extends('admin.layouts.app')

@section('title', 'Appointments')

@section('content')
  <!-- Header -->
  <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-4xl font-bold text-white">Appointments</h1>
      <p class="mt-2 text-sm text-[#B0B0B0]">Manage all bookings, status, and services.</p>
    </div>
    <a href="{{ route('admin.appointments.create') }}" class="btn-accent inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      New Appointment
    </a>
  </div>

  @include('admin.partials.alerts')

  <!-- Filter Bar -->
  <div class="mb-6">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex items-center gap-4">
      <label for="status" class="text-sm font-medium text-[#B0B0B0]">Filter by Status:</label>
      <select name="status" id="status" class="bg-[#1A1A1A] border border-[#2A2A2A] text-white rounded-lg px-4 py-2 text-sm focus:border-[#CA8A04] focus:outline-none transition w-48">
        <option value="">All Statuses</option>
        <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>✓ Done</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⧖ Pending</option>
        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>✕ Cancelled</option>
      </select>
    </form>
  </div>

  <!-- Table -->
  <div class="card rounded-xl overflow-hidden">
    <table class="w-full text-sm text-[#B0B0B0]">
      <thead class="bg-[#1A1A1A] border-b border-[#2A2A2A]">
        <tr>
          <th class="px-6 py-4 text-left font-semibold text-white">Customer</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Stylist</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Services</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Date & Time</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Status</th>
          <th class="px-6 py-4 text-left font-semibold text-white">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-[#2A2A2A]">
        @forelse($appointments as $appointment)
          <tr class="hover:bg-[#1A1A1A] transition">
            <td class="px-6 py-4 text-white">{{ $appointment->customer->name }}</td>
            <td class="px-6 py-4 text-white">{{ $appointment->stylist->name }}</td>
            <td class="px-6 py-4 text-white">
              <span class="text-xs text-[#CA8A04]">{{ $appointment->services->pluck('service_name')->join(', ') }}</span>
            </td>
            <td class="px-6 py-4 text-white text-sm">{{ $appointment->appointment_datetime->format('M d, Y • H:i') }}</td>
            <td class="px-6 py-4">
              @php
                $statusConfig = [
                  'pending' => ['label' => 'Pending', 'class' => 'bg-[#CA8A04] bg-opacity-20 text-[#CA8A04]'],
                  'done' => ['label' => 'Done', 'class' => 'bg-green-500 bg-opacity-20 text-green-400'],
                  'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-red-500 bg-opacity-20 text-red-400'],
                ];
                $config = $statusConfig[$appointment->status] ?? $statusConfig['pending'];
              @endphp
              <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $config['class'] }}">
                {{ $config['label'] }}
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.appointments.edit', $appointment) }}" title="Edit" class="p-2 text-[#B0B0B0] hover:text-[#CA8A04] hover:bg-[#1A1A1A] rounded-lg transition">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                
                <!-- Done -->
                <form action="{{ route('admin.appointments.done', $appointment) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" title="Mark Done" {{ $appointment->status === 'done' ? 'disabled' : '' }} class="p-2 text-[#B0B0B0] hover:text-green-400 hover:bg-[#1A1A1A] rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                    </svg>
                  </button>
                </form>
                
                <!-- Cancel -->
                <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="POST" class="inline">
                  @csrf
                  <button type="submit" title="Cancel" {{ $appointment->status === 'cancelled' ? 'disabled' : '' }} class="p-2 text-[#B0B0B0] hover:text-red-400 hover:bg-[#1A1A1A] rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <p>No appointments found</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="bg-[#1A1A1A] border-t border-[#2A2A2A] px-6 py-4">
      {{ $appointments->links() }}
    </div>
  </div>

  <script>
    document.getElementById('status').addEventListener('change', function () {
      this.closest('form').submit();
    });
  </script>
@endsection
