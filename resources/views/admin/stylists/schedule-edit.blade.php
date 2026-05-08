@extends('admin.layouts.app')

@section('title', 'Edit Schedule')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Edit Schedule</h1>
      <p class="mt-2 text-sm text-slate-600">Update the schedule for {{ $stylist->name }}.</p>
    </div>
    <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to Schedule</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.stylists-schedule.update', $schedule->id) }}" class="max-w-2xl rounded-[28px] bg-white p-6 shadow-sm">
    @csrf

    <div class="grid gap-6 lg:grid-cols-3">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Day</label>
        <select name="day" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
          <option value="">Select day</option>
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}" {{ old('day', $schedule->day) === $day ? 'selected' : '' }}>{{ $day }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Start Time</label>
        <input type="time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">End Time</label>
        <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
      </div>
    </div>

    <div class="mt-6 flex gap-4">
      <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Update Schedule</button>
      <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
  </form>
@endsection
