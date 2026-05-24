@extends('admin.layouts.app')

@section('title', 'Stylist Details')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ $stylist->name }}</h1>
      <p class="mt-2 text-sm text-slate-600">Review stylist details and services.</p>
    </div>
    <a href="{{ route('admin.stylists.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back</a>
  </div>

  <div class="rounded-[28px] bg-white p-6 shadow-sm">
    <p class="text-sm font-semibold text-slate-700">Services</p>
    <p class="mb-4 text-slate-600">{{ $stylist->services->pluck('service_name')->join(', ') ?: 'None' }}</p>

    <p class="text-sm font-semibold text-slate-700">Schedules</p>
    <ul class="mb-4 list-disc space-y-2 pl-6 text-slate-600">
      @forelse($stylist->schedules as $schedule)
        <li>{{ $schedule->day }} • {{ $schedule->start_time }} - {{ $schedule->end_time }}</li>
      @empty
        <li>No schedule entries.</li>
      @endforelse
    </ul>
  </div>
@endsection
