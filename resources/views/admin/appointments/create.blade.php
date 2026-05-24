@extends('admin.layouts.app')

@section('title', 'Create Appointment')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Create Appointment</h1>
      <p class="mt-2 text-sm text-slate-600">Create a booking and attach services to it.</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to appointments</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.appointments.store') }}" class="space-y-6 rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    @include('admin.appointments.form')
  </form>
@endsection
