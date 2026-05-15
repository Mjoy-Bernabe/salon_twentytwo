@extends('admin.layouts.app')

@section('title', 'Stylists')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Stylists</h1>
      <p class="mt-2 text-sm text-slate-600">Manage stylists, their services, and their schedules.</p>
    </div>
    <a href="{{ route('admin.stylists.create') }}" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Add Stylist</a>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-6 rounded-[28px] bg-white p-6 shadow-sm">
    <form method="GET" action="{{ route('admin.stylists.index') }}" class="grid gap-4 md:grid-cols-[1fr_auto]">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Search by Name or Email</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter stylist name or email" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
      <div class="flex items-end gap-2">
        <button type="submit" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">Search</button>
        <a href="{{ route('admin.stylists.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Reset</a>
      </div>
    </form>
  </div>

  <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full table-fixed divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="w-[18%] px-6 py-4 font-semibold text-slate-600">Name</th>
          <th class="w-[52%] px-6 py-4 font-semibold text-slate-600">Services</th>
          <th class="w-[10%] px-6 py-4 font-semibold text-slate-600">Schedules</th>
          <th class="w-[20%] px-6 py-4 font-semibold text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @foreach($stylists as $stylist)
          <tr>
            <td class="px-6 py-4 align-top font-medium text-slate-900">{{ $stylist->name }}</td>
            <td class="px-6 py-4 align-top">
              @if($stylist->services->isEmpty())
                <span class="text-slate-500">No services</span>
              @else
                <div class="flex flex-wrap gap-2">
                  @foreach($stylist->services->take(5) as $service)
                    <span class="rounded-full border border-slate-300 bg-slate-50 px-3 py-1 text-xs text-slate-700">
                      {{ $service->service_name }}
                    </span>
                  @endforeach
                  @if($stylist->services->count() > 5)
                    <span
                      class="cursor-help rounded-full border border-slate-300 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700"
                      title="{{ $stylist->services->slice(5)->pluck('service_name')->join(', ') }}"
                    >
                      ... +{{ $stylist->services->count() - 5 }} more
                    </span>
                  @endif
                </div>
              @endif
            </td>
            <td class="px-6 py-4 align-top font-semibold text-slate-700">{{ $stylist->schedules->count() }}</td>
            <td class="px-6 py-4 align-top">
              <div class="flex items-center gap-2 whitespace-nowrap">
                <a href="{{ route('admin.stylists.edit', $stylist) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
                <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" class="rounded-full bg-slate-500 px-3 py-2 text-xs text-white hover:bg-slate-600">Schedule</a>
                <form action="{{ route('admin.stylists.destroy', $stylist) }}" method="POST" class="inline" data-confirm data-confirm-title="Delete Stylist" data-confirm-message="Delete stylist '{{ $stylist->name }}'? This action cannot be undone.">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="rounded-full bg-rose-500 px-3 py-2 text-xs text-white hover:bg-rose-600">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="border-t border-slate-200 bg-white px-6 py-4">
      {{ $stylists->links() }}
    </div>
  </div>
@endsection
