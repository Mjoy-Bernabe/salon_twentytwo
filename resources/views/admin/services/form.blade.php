<div class="space-y-5">
  @php
    $isPromoForm = old('is_promo', isset($isPromoForm) && $isPromoForm ? 1 : 0);
  @endphp

  <input type="hidden" name="is_promo" value="{{ $isPromoForm ? 1 : 0 }}">

  

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Service Name</label>
    <input type="text" name="service_name" value="{{ old('service_name', $service->service_name ?? '') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $service->price ?? '') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
    <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">{{ old('description', $service->description ?? '') }}</textarea>
  </div>

  <div>
    <p class="mb-2 text-sm font-medium text-slate-700">Assign stylists</p>
    <div class="grid gap-2 sm:grid-cols-2">
      @foreach($stylists as $stylist)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input type="checkbox" name="stylist_ids[]" value="{{ $stylist->id }}" {{ in_array($stylist->id, old('stylist_ids', $selectedStylists ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500" />
          <span>{{ $stylist->name }}</span>
        </label>
      @endforeach
    </div>
  </div>
<!-- 
  @if($isPromoForm)
    <div>
      <p class="mb-2 text-sm font-medium text-slate-700">Included services</p>
      <div class="grid gap-2 sm:grid-cols-2">
        @forelse($baseServices as $baseService)
          <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
            <input type="checkbox" name="component_service_ids[]" value="{{ $baseService->id }}" {{ in_array($baseService->id, old('component_service_ids', $selectedComponents ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500" />
            <span>{{ $baseService->service_name }}</span>
          </label>
        @empty
          <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500">
            Add normal services first before creating a promo package.
          </div>
        @endforelse
      </div>
    </div>
  @endif -->

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Service</button>
</div>
