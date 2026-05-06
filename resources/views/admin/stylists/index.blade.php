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

  <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-6 py-4 font-semibold text-slate-600">Name</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Services</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Schedules</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @foreach($stylists as $stylist)
          <tr>
            <td class="px-6 py-4">{{ $stylist->name }}</td>
            <td class="px-6 py-4">{{ $stylist->services->pluck('service_name')->join(', ') }}</td>
            <td class="px-6 py-4">{{ $stylist->schedules->count() }}</td>
            <td class="px-6 py-4 space-x-2">
              <a href="{{ route('admin.stylists.edit', $stylist) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
              <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" class="rounded-full bg-slate-500 px-3 py-2 text-xs text-white hover:bg-slate-600">Schedule</a>
              <form action="{{ route('admin.stylists.destroy', $stylist) }}" method="POST" class="inline-block">
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
      {{ $stylists->links() }}
    </div>
  </div>
@endsection
