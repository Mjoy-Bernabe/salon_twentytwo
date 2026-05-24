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

    <div class="grid gap-6">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Day</label>
        <select name="day" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
          <option value="">Select day</option>
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}" {{ old('day', $schedule->day) === $day ? 'selected' : '' }}>{{ $day }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
        <p class="mb-3 text-sm font-semibold text-slate-800">1. Select Start Time</p>
        <div class="grid grid-cols-3 gap-2">
          <select id="start_hour" class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">Hour</option>
          </select>
          <select id="start_minute" class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">Min</option>
          </select>
          <select id="start_ampm" class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">AM/PM</option>
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
        </div>
      </div>

      <div id="end_time_card" class="rounded-2xl border border-slate-200 bg-slate-50 p-4 opacity-60">
        <p class="mb-3 text-sm font-semibold text-slate-800">2. Select End Time</p>
        <div class="grid grid-cols-3 gap-2">
          <select id="end_hour" disabled class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">Hour</option>
          </select>
          <select id="end_minute" disabled class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">Min</option>
          </select>
          <select id="end_ampm" disabled class="rounded-xl border border-slate-300 bg-white px-3 py-2 outline-none focus:border-slate-900">
            <option value="">AM/PM</option>
            <option value="AM">AM</option>
            <option value="PM">PM</option>
          </select>
        </div>
      </div>
    </div>

    <input type="hidden" id="start_time" name="start_time" value="{{ old('start_time', substr($schedule->start_time, 0, 5)) }}" required>
    <input type="hidden" id="end_time" name="end_time" value="{{ old('end_time', substr($schedule->end_time, 0, 5)) }}" required>

    <div class="mt-6 flex gap-4">
      <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Update Schedule</button>
      <a href="{{ route('admin.stylists.schedule', $stylist->id) }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
  </form>

  <script>
    (() => {
      const startHour = document.getElementById('start_hour');
      const startMinute = document.getElementById('start_minute');
      const startAmpm = document.getElementById('start_ampm');
      const endHour = document.getElementById('end_hour');
      const endMinute = document.getElementById('end_minute');
      const endAmpm = document.getElementById('end_ampm');
      const startTimeInput = document.getElementById('start_time');
      const endTimeInput = document.getElementById('end_time');
      const endTimeCard = document.getElementById('end_time_card');

      const fillHours = (el) => {
        for (let i = 1; i <= 12; i++) {
          const value = String(i).padStart(2, '0');
          el.insertAdjacentHTML('beforeend', `<option value="${value}">${value}</option>`);
        }
      };
      const fillMinutes = (el) => {
        ['00', '30'].forEach((minute) => el.insertAdjacentHTML('beforeend', `<option value="${minute}">${minute}</option>`));
      };

      const to24Hour = (hour12, ampm) => {
        let hour = Number(hour12);
        if (ampm === 'AM' && hour === 12) hour = 0;
        if (ampm === 'PM' && hour !== 12) hour += 12;
        return String(hour).padStart(2, '0');
      };

      const toMinutes = (hhmm) => {
        const [h, m] = hhmm.split(':').map(Number);
        return (h * 60) + m;
      };

      const buildTime = (hour, minute, ampm) => {
        if (!hour || !minute || !ampm) return '';
        return `${to24Hour(hour, ampm)}:${minute}`;
      };

      const set12HourPicker = (time, hourEl, minuteEl, ampmEl) => {
        if (!time) return;
        const [hStr, mStr] = time.substring(0, 5).split(':');
        let h = Number(hStr);
        const ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12;
        if (h === 0) h = 12;
        hourEl.value = String(h).padStart(2, '0');
        minuteEl.value = mStr;
        ampmEl.value = ampm;
      };

      const enableEnd = (enabled) => {
        [endHour, endMinute, endAmpm].forEach((el) => { el.disabled = !enabled; });
        endTimeCard.classList.toggle('opacity-60', !enabled);
      };

      const updateStart = () => {
        const start = buildTime(startHour.value, startMinute.value, startAmpm.value);
        startTimeInput.value = start;
        enableEnd(Boolean(start));
        if (!start) {
          endTimeInput.value = '';
          endHour.value = '';
          endMinute.value = '';
          endAmpm.value = '';
        }
        updateEnd();
      };

      const updateEnd = () => {
        const start = startTimeInput.value;
        const end = buildTime(endHour.value, endMinute.value, endAmpm.value);
        if (!start || !end) {
          endTimeInput.value = '';
          return;
        }
        if (toMinutes(end) <= toMinutes(start)) {
          endTimeInput.value = '';
          return;
        }
        endTimeInput.value = end;
      };

      fillHours(startHour);
      fillHours(endHour);
      fillMinutes(startMinute);
      fillMinutes(endMinute);

      [startHour, startMinute, startAmpm].forEach((el) => el.addEventListener('change', updateStart));
      [endHour, endMinute, endAmpm].forEach((el) => el.addEventListener('change', updateEnd));

      set12HourPicker(startTimeInput.value, startHour, startMinute, startAmpm);
      enableEnd(Boolean(startTimeInput.value));
      set12HourPicker(endTimeInput.value, endHour, endMinute, endAmpm);
      updateEnd();
    })();
  </script>
@endsection
