@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Services</h1>
      <p class="mt-2 text-sm text-slate-600">Manage service pricing, promos, and stylist availability.</p>
    </div>
    <a href="{{ route('admin.services.create', $tab === 'promo' ? ['is_promo' => 1] : []) }}" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Add {{ $tab === 'promo' ? 'Promo' : 'Service' }}</a>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-6 flex flex-wrap gap-2">
    <a href="?tab=all" class="rounded-full px-4 py-2 text-sm font-medium {{ $tab === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">All</a>
    <a href="?tab=service" class="rounded-full px-4 py-2 text-sm font-medium {{ $tab === 'service' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Services</a>
    <a href="?tab=promo" class="rounded-full px-4 py-2 text-sm font-medium {{ $tab === 'promo' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Promos</a>
  </div>

  <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-6 py-4 font-semibold text-slate-600">Name</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Price</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Promo</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Combo items</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Stylists</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @foreach($services as $service)
          <tr>
            <td class="px-6 py-4">{{ $service->service_name }}</td>
            <td class="px-6 py-4">₱{{ number_format($service->price, 2) }}</td>
            <td class="px-6 py-4">{{ $service->is_promo ? 'Yes' : 'No' }}</td>
            <td class="px-6 py-4">{{ $service->is_promo ? $service->components->pluck('service_name')->join(', ') : '-' }}</td>
            <td class="px-6 py-4">{{ $service->stylists->pluck('name')->join(', ') }}</td>
            <td class="px-6 py-4 space-x-2">
              <a href="{{ route('admin.services.edit', $service) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
              <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" data-confirm data-confirm-title="Delete Service" data-confirm-message="Delete '{{ $service->service_name }}'? This action cannot be undone.">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-full bg-rose-500 px-3 py-2 text-xs text-white hover:bg-rose-600">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="border-t border-slate-200 bg-white px-6 py-4">
      {{ $services->links() }}
    </div>
  </div>

@endsection
