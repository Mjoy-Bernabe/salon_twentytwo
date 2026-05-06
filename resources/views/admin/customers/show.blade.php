@extends('admin.layouts.app')

@section('title', 'Customer History')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ $customer->name }}</h1>
      <p class="mt-2 text-sm text-slate-600">Customer details and full appointment history.</p>
    </div>
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.customers.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Back to customers</a>
        <a href="{{ route('admin.customers.edit', $customer) }}" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Edit Customer</a>
      </div>
      <h2 class="text-lg font-semibold text-slate-900">Profile</h2>
      <div class="mt-4 space-y-3 text-sm text-slate-700">
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Contact:</strong> {{ $customer->contact_num ?? '—' }}</p>
        <p><strong>Status:</strong> {{ $customer->active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Total appointments:</strong> {{ $customer->appointments->count() }}</p>
      </div>
    </div>
    <div class="rounded-[28px] bg-white p-6 shadow-sm lg:col-span-2">
      <h2 class="text-lg font-semibold text-slate-900">Appointment History</h2>
      @if($customer->appointments->isEmpty())
        <p class="mt-4 text-sm text-slate-500">No appointments found for this customer.</p>
      @else
        <div class="mt-4 overflow-hidden rounded-[28px] border border-slate-200">
          <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50">
              <tr>
                <th class="px-6 py-4 font-semibold text-slate-600">Date</th>
                <th class="px-6 py-4 font-semibold text-slate-600">Stylist</th>
                <th class="px-6 py-4 font-semibold text-slate-600">Services</th>
                <th class="px-6 py-4 font-semibold text-slate-600">Status</th>
                <th class="px-6 py-4 font-semibold text-slate-600">Downpayment</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
              @foreach($customer->appointments as $appointment)
                <tr>
                  <td class="px-6 py-4">{{ $appointment->appointment_datetime->format('M d, Y H:i') }}</td>
                  <td class="px-6 py-4">{{ $appointment->stylist->name }}</td>
                  <td class="px-6 py-4">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
                  <td class="px-6 py-4">{{ ucfirst($appointment->status) }}</td>
                  <td class="px-6 py-4">₱{{ number_format($appointment->downpayment_amount, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
@endsection
