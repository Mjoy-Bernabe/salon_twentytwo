@extends('admin.layouts.app')

@section('title', 'Edit Appointment')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Edit Appointment</h1>
      <p class="mt-2 text-sm text-slate-600">Update booking details and status.</p>
    </div>
    <a href="{{ route('admin.appointments.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to appointments</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}" class="space-y-6 rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    @method('PUT')
    @include('admin.appointments.form')
  </form>
@endsection
