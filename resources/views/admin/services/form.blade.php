<div class="space-y-5">
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

  @if(isset($isPromoTab) && $isPromoTab)
    <input type="hidden" name="is_promo" value="1" />
    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
      <p class="text-sm font-semibold text-slate-900">Promo bundle</p>
      <p class="text-sm text-slate-600">This promo will be saved as a bundle. You can select one or more services below.</p>
    </div>
  @else
    <div class="flex items-center gap-3">
      <input id="is_promo" type="checkbox" name="is_promo" value="1" {{ old('is_promo', isset($isPromoTab) && $isPromoTab ? true : ($service->is_promo ?? false)) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
      <label for="is_promo" class="text-sm text-slate-700">Promo bundle</label>
    </div>
  @endif

  <div id="promo-components" class="{{ old('is_promo', isset($isPromoTab) && $isPromoTab ? true : ($service->is_promo ?? false)) ? '' : 'hidden' }} space-y-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
    <p class="text-sm font-semibold text-slate-900">Promo components</p>
    <p class="text-sm text-slate-600">Choose the services included in this promo bundle.</p>
    <div class="grid gap-2 sm:grid-cols-2">
      @foreach($baseServices as $baseService)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3">
          <input type="checkbox" name="component_service_ids[]" value="{{ $baseService->id }}" {{ in_array($baseService->id, old('component_service_ids', $selectedComponents ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
          <span>{{ $baseService->service_name }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <div>
    <p class="mb-2 text-sm font-medium text-slate-700">Assign stylists</p>
    <div class="grid gap-2 sm:grid-cols-2">
      @foreach($stylists as $stylist)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input type="checkbox" name="stylist_ids[]" value="{{ $stylist->id }}" {{ in_array($stylist->id, old('stylist_ids', $selectedStylists ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
          <span>{{ $stylist->name }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Service</button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const promoCheckbox = document.getElementById('is_promo');
    const promoSection = document.getElementById('promo-components');

    function togglePromoSection() {
      promoSection.classList.toggle('hidden', !promoCheckbox.checked);
    }

    promoCheckbox.addEventListener('change', togglePromoSection);
    togglePromoSection(); // Check on page load
  });
</script>
