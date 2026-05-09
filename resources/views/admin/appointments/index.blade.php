@extends('admin.layouts.app')

@section('title', 'Appointments')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Appointments</h1>
      <p class="mt-2 text-sm text-slate-600">Manage bookings, adjust status, and attach services.</p>
    </div>
    <a href="{{ route('admin.appointments.create') }}" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Add Appointment</a>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-6 rounded-[28px] bg-white p-6 shadow-sm">
    <form method="GET" action="{{ route('admin.appointments.index') }}" id="appointment-filter-form" class="grid gap-4 md:grid-cols-2">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Search by Name or Email</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Customer or stylist name/email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Filter by Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
          <option value="">All Appointments</option>
          <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
          <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>
          <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
      </div>
      <div class="md:col-span-2 flex gap-2">
        <button type="submit" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Search</button>
        <a href="{{ route('admin.appointments.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Reset</a>
      </div>
    </form>
  </div>

  <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-6 py-4 font-semibold text-slate-600">Customer</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Stylist</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Services</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Date</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Status</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @foreach($appointments as $appointment)
          <tr>
            <td class="px-6 py-4">{{ $appointment->customer->name }}</td>
            <td class="px-6 py-4">{{ $appointment->stylist->name }}</td>
            <td class="px-6 py-4">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
            <td class="px-6 py-4">{{ $appointment->appointment_datetime->format('M d, Y H:i') }}</td>
            <td class="px-6 py-4">
              @if($appointment->status === 'confirmed')
                <span class="inline-block rounded-full bg-amber-500/20 px-3 py-1 text-xs font-semibold text-amber-400">Confirmed</span>
              @elseif($appointment->status === 'done')
                <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Done</span>
              @elseif($appointment->status === 'cancelled')
                <span class="inline-block rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">Cancelled</span>
              @else
                <span class="inline-block rounded-full bg-slate-200/30 px-3 py-1 text-xs font-semibold text-slate-300">{{ ucfirst($appointment->status) }}</span>
              @endif
            </td>
            <td class="px-6 py-4">
              <div class="flex flex-wrap items-center gap-2">
              @if($appointment->status !== 'done' && $appointment->status !== 'cancelled')
                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
              @endif
              @if($appointment->status !== 'done' && $appointment->status !== 'cancelled')
                <form action="{{ route('admin.appointments.confirm', $appointment) }}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="rounded-full bg-emerald-500 px-3 py-2 text-xs text-white hover:bg-emerald-600">Confirm</button>
                </form>
                <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="rounded-full bg-rose-500 px-3 py-2 text-xs text-white hover:bg-rose-600">Cancel</button>
                </form>
              @endif
              @if($appointment->status !== 'done' && $appointment->status !== 'cancelled')
                <form action="{{ route('admin.appointments.done', $appointment) }}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="rounded-full bg-blue-500 px-3 py-2 text-xs text-white hover:bg-blue-600">Done</button>
                </form>
              @endif
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="border-t border-slate-200 bg-white px-6 py-4">
      {{ $appointments->links() }}
    </div>
  </div>
@endsection
