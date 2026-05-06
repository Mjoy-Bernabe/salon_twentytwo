@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Dashboard</h1>
      <p class="mt-2 text-sm text-slate-600">Admin overview for revenue, stylists, and customers.</p>
    </div>
    <div class="flex flex-wrap gap-2">
      <a href="{{ route('admin.services.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Services</a>
      <a href="{{ route('admin.stylists.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Stylists</a>
      <a href="{{ route('admin.appointments.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Appointments</a>
    </div>
  </div>

  @include('admin.partials.alerts')

  <div class="grid gap-5 lg:grid-cols-3">
    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Revenue (done)</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900">₱{{ number_format($revenue, 2) }}</p>
    </article>

    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Active Stylists</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $activeStylists }}</p>
    </article>

    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Total Customers</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $totalCustomers }}</p>
    </article>
  </div>
@endsection
