<div class="space-y-5">
  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Stylist Name</label>
    <input type="text" name="name" value="{{ old('name', $stylist->name ?? '') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <p class="mb-2 text-sm font-medium text-slate-700">Services handled by this stylist</p>
    <div class="grid gap-2 sm:grid-cols-2">
      @foreach($services as $service)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" {{ in_array($service->id, old('service_ids', $selectedServices ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
          <span>{{ $service->service_name }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Stylist</button>
</div>
