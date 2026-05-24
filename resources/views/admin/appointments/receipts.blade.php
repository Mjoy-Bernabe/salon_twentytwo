@extends('admin.layouts.app')

@section('title', 'Appointment History')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Appointment History</h1>
      <p class="mt-2 text-sm text-slate-600">Completed and fully paid appointments.</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Back to appointments</a>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-6 rounded-[28px] bg-white p-6 shadow-sm">
    <form method="GET" action="{{ route('admin.appointments.receipts') }}" class="grid gap-4 md:grid-cols-[1fr_auto_auto] md:items-end">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Search by Customer or Stylist</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
      <button type="submit" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Search</button>
      <a href="{{ route('admin.appointments.receipts') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Reset</a>
    </form>
  </div>

  <div class="overflow-x-auto rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-6 py-4 font-semibold text-slate-600">Receipt</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Customer</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Stylist</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Services</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Appointment</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Completed</th>
          <th class="px-6 py-4 text-right font-semibold text-slate-600">Total</th>
          <th class="px-6 py-4 text-right font-semibold text-slate-600">Paid</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @forelse($appointments as $appointment)
          @php
            $total = $appointment->services->sum('price');
          @endphp
          <tr class="hover:bg-slate-50">
            <td class="px-6 py-4 font-semibold text-slate-900">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</td>
            <td class="px-6 py-4">
              <div class="font-medium text-slate-900">{{ $appointment->customer->name }}</div>
              <div class="text-xs text-slate-500">{{ $appointment->customer->email }}</div>
            </td>
            <td class="px-6 py-4">{{ $appointment->stylist->name }}</td>
            <td class="px-6 py-4">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
            <td class="px-6 py-4">{{ $appointment->appointment_datetime->format('M d, Y H:i') }}</td>
            <td class="px-6 py-4">{{ $appointment->updated_at->format('M d, Y H:i') }}</td>
            <td class="px-6 py-4 text-right font-semibold text-slate-900">&#8369;{{ number_format($total, 2) }}</td>
            <td class="px-6 py-4 text-right font-semibold text-emerald-700">&#8369;{{ number_format($total, 2) }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="px-6 py-12 text-center text-sm text-slate-500">
              No completed appointments yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    {{ $appointments->links() }}
  </div>
@endsection
