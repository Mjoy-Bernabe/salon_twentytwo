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
            <td class="px-6 py-4">{{ ucfirst($appointment->status) }}</td>
            <td class="px-6 py-4 space-x-2">
              <a href="{{ route('admin.appointments.edit', $appointment) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
              <form action="{{ route('admin.appointments.confirm', $appointment) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="rounded-full bg-emerald-500 px-3 py-2 text-xs text-white hover:bg-emerald-600">Confirm</button>
              </form>
              <form action="{{ route('admin.appointments.done', $appointment) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="rounded-full bg-blue-500 px-3 py-2 text-xs text-white hover:bg-blue-600">Done</button>
              </form>
              <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="rounded-full bg-rose-500 px-3 py-2 text-xs text-white hover:bg-rose-600">Cancel</button>
              </form>
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
