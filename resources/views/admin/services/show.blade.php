@extends('admin.layouts.app')

@section('title', 'Service Details')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ $service->service_name }}</h1>
      <p class="mt-2 text-sm text-slate-600">View service details and assigned stylists.</p>
    </div>
    <a href="{{ route('admin.services.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back</a>
  </div>

  <div class="rounded-[28px] bg-white p-6 shadow-sm">
    <p class="text-sm font-semibold text-slate-700">Price</p>
    <p class="mb-4 text-xl text-slate-900">₱{{ number_format($service->price, 2) }}</p>
    <p class="text-sm font-semibold text-slate-700">Promo</p>
    <p class="mb-4 text-slate-600">{{ $service->is_promo ? 'Yes' : 'No' }}</p>
    <p class="text-sm font-semibold text-slate-700">Description</p>
    <p class="mb-4 text-slate-600">{{ $service->description ?? 'No description provided.' }}</p>
    <p class="text-sm font-semibold text-slate-700">Assigned Stylists</p>
    <p class="text-slate-600">{{ $service->stylists->pluck('name')->join(', ') ?: 'None' }}</p>
  </div>
@endsection
