@extends('admin.layouts.app')

@section('title', 'Stylist Schedule')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">{{ $stylist->name }} Schedule</h1>
      <p class="mt-2 text-sm text-slate-600">Add or review available time slots for this stylist.</p>
    </div>
    <a href="{{ route('admin.stylists.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to stylists</a>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-8 rounded-[28px] bg-white p-6 shadow-sm">
    <h2 class="mb-4 text-xl font-semibold text-slate-900">Existing Schedule</h2>
    @if($stylist->schedules->count() > 0)
      <div class="grid gap-4 md:grid-cols-2">
        @foreach($stylist->schedules as $schedule)
          <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
            <div class="flex items-start justify-between">
              <div>
                <p class="font-semibold text-slate-900">{{ $schedule->day }}</p>
                <p class="text-sm text-slate-600">{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
              </div>
              <div class="flex gap-2">
                <a href="{{ route('admin.stylists-schedule.edit', $schedule->id) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">Edit</a>
                <form action="{{ route('admin.stylists-schedule.delete', $schedule->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="rounded-full bg-rose-500 px-3 py-2 text-xs text-white hover:bg-rose-600" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-sm text-slate-600">No schedule entries yet.</p>
    @endif
  </div>

  <form method="POST" action="{{ route('admin.stylists.schedule.store', $stylist->id) }}" class="rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    <div class="grid gap-6 lg:grid-cols-3">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Day</label>
        <select name="day" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
          <option value="">Select day</option>
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>{{ $day }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Start Time</label>
        <input type="time" name="start_time" value="{{ old('start_time') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">End Time</label>
        <input type="time" name="end_time" value="{{ old('end_time') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
    </div>

    <button type="submit" class="mt-6 rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Add Schedule</button>
  </form>
@endsection
