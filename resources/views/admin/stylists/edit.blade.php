@extends('admin.layouts.app')

@section('title', 'Edit Stylist')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Edit Stylist</h1>
      <p class="mt-2 text-sm text-slate-600">Update stylist details and the services they offer.</p>
    </div>
    <a href="{{ route('admin.stylists.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to stylists</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.stylists.update', $stylist) }}" class="space-y-6 rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    @method('PUT')
    @include('admin.stylists.form')
  </form>
@endsection
