@extends('admin.layouts.app')

@section('title', 'Appointment Details')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Appointment #{{ $appointment->id }}</h1>
      <p class="mt-2 text-sm text-slate-600">Review appointment details and related services.</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back</a>
  </div>

  <div class="rounded-[28px] bg-white p-6 shadow-sm">
    <p class="text-sm font-semibold text-slate-700">Customer</p>
    <p class="mb-4 text-slate-600">{{ $appointment->customer->name }} ({{ $appointment->customer->email }})</p>

    <p class="text-sm font-semibold text-slate-700">Stylist</p>
    <p class="mb-4 text-slate-600">{{ $appointment->stylist->name }}</p>

    <p class="text-sm font-semibold text-slate-700">Date</p>
    <p class="mb-4 text-slate-600">{{ $appointment->appointment_datetime->format('M d, Y H:i') }}</p>

    <p class="text-sm font-semibold text-slate-700">Status</p>
    <p class="mb-4 text-slate-600">{{ ucfirst($appointment->status) }}</p>

    <p class="text-sm font-semibold text-slate-700">Downpayment</p>
    <p class="mb-4 text-slate-600">₱{{ number_format($appointment->downpayment_amount, 2) }}</p>

    <p class="text-sm font-semibold text-slate-700">Services</p>
    <p class="text-slate-600">{{ $appointment->services->pluck('service_name')->join(', ') }}</p>
  </div>
@endsection
