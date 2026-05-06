@extends('admin.layouts.app')

@section('title', isset($isPromoTab) && $isPromoTab ? 'Create Promo' : 'Create Service')

@section('content')
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ isset($isPromoTab) && $isPromoTab ? 'Create Promo' : 'Create Service' }}</h1>
      <p class="mt-2 text-sm text-slate-600">{{ isset($isPromoTab) && $isPromoTab ? 'Add a new promo bundle and select eligible services.' : 'Add a new service and assign it to available stylists.' }}</p>
    </div>
    <a href="{{ route('admin.services.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to services</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-6 rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    @include('admin.services.form')
  </form>
@endsection
