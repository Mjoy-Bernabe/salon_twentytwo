@extends('admin.layouts.app')

@section('title', $customer->name)

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ $customer->name }}</h1>
      <p class="mt-2 text-sm text-slate-600">Manage customer details and appointment history.</p>
    </div>
    <a href="{{ route('admin.customers.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to Customers</a>
  </div>

  @include('admin.partials.alerts')

  <div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1">
      <div class="rounded-[28px] bg-white p-6 shadow-sm">
        <h2 class="mb-6 text-xl font-semibold text-slate-900">Customer Details</h2>
        <dl class="space-y-4">
          <div>
            <dt class="text-sm font-medium text-slate-600">Name</dt>
            <dd class="mt-1 text-slate-900">{{ $customer->name }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-slate-600">Email</dt>
            <dd class="mt-1 text-slate-900">{{ $customer->email }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-slate-600">Contact Number</dt>
            <dd class="mt-1 text-slate-900">{{ $customer->contact_num ?? '-' }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-slate-600">Status</dt>
            <dd class="mt-1">
              <span class="inline-flex rounded-full {{ $customer->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} px-3 py-1 text-xs font-semibold">
                {{ $customer->is_active ? 'Active' : 'Inactive' }}
              </span>
            </dd>
          </div>
        </dl>
        <a href="{{ route('admin.customers.edit', $customer) }}" class="mt-6 block w-full rounded-2xl bg-slate-900 px-5 py-3 text-center text-white hover:bg-slate-700">Edit Customer</a>
      </div>
    </div>

    <div class="lg:col-span-2">
      <div class="rounded-[28px] bg-white p-6 shadow-sm">
        <h2 class="mb-6 text-xl font-semibold text-slate-900">Appointment History</h2>
        @if($customer->appointments->count() > 0)
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-6 py-4 font-semibold text-slate-600">Stylist</th>
                  <th class="px-6 py-4 font-semibold text-slate-600">Services</th>
                  <th class="px-6 py-4 font-semibold text-slate-600">Date</th>
                  <th class="px-6 py-4 font-semibold text-slate-600">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200">
                @foreach($customer->appointments as $appointment)
                  <tr>
                    <td class="px-6 py-4">{{ $appointment->stylist->name }}</td>
                    <td class="px-6 py-4 text-xs">{{ $appointment->services->pluck('service_name')->join(', ') }}</td>
                    <td class="px-6 py-4">{{ $appointment->appointment_datetime->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4">
                      <span class="inline-flex rounded-full {{ $appointment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-700' : ($appointment->status === 'cancelled' ? 'bg-rose-50 text-rose-700' : ($appointment->status === 'done' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700')) }} px-3 py-1 text-xs font-semibold">
                        {{ ucfirst($appointment->status) }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <p class="text-sm text-slate-600">No appointments yet.</p>
        @endif
      </div>
    </div>
  </div>
@endsection
