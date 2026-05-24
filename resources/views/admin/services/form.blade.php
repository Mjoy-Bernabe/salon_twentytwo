<div class="space-y-5">
  @php
    $service = $service ?? null;
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
    <label class="mb-2 block text-sm font-medium text-slate-700">Estimated Time (minutes)</label>
    <input type="number" min="1" name="estimated_time" value="{{ old('estimated_time', $service->estimated_time ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
    <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">{{ old('description', $service->description ?? '') }}</textarea>
  </div>

  <div>
    <p class="mb-2 text-sm font-medium text-slate-700">Category</p>
    <div class="space-y-2">
      @foreach(['Signature Colour', 'Signature Cut', 'Special Services'] as $categoryOption)
        <label class="category-option relative flex cursor-pointer items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input
            type="radio"
            name="category"
            value="{{ $categoryOption }}"
            {{ old('category', data_get($service, 'category', '')) === $categoryOption ? 'checked' : '' }}
            {{ $loop->first ? 'required' : '' }}
            class="category-radio absolute inset-0 opacity-0 cursor-pointer"
          />
          <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-[#d4af37]">
            <span class="category-dot h-2.5 w-2.5 rounded-full bg-[#d4af37] opacity-0"></span>
          </span>
          <span>{{ $categoryOption }}</span>
        </label>
      @endforeach

      @error('category')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
      @enderror
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const radios = document.querySelectorAll('.category-radio');

      const syncCategoryDots = () => {
        radios.forEach((radio) => {
          const label = radio.closest('.category-option');
          const dot = label?.querySelector('.category-dot');
          if (!dot) return;
          dot.style.opacity = radio.checked ? '1' : '0';
        });
      };

      radios.forEach((radio) => {
        radio.addEventListener('change', syncCategoryDots);
      });

      syncCategoryDots();
    });
  </script>

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

  @if($isPromoForm)
    @php
      $serviceOptions = $baseServices->map(fn ($baseService) => [
        'id' => $baseService->id,
        'service_name' => $baseService->service_name,
      ])->values();
      $oldSelectedComponents = old('component_service_ids', $selectedComponents ?? []);
    @endphp
    <div>
      <p class="mb-2 text-sm font-medium text-slate-700">Included services</p>
      <div class="space-y-3">
        @if($baseServices->isEmpty())
          <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500">
            Add normal services first before creating a promo package.
          </div>
        @else
          <div class="relative">
            <input
              type="text"
              id="component-service-search"
              placeholder="Search service (e.g. ha)"
              class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900"
            />
            <div id="component-service-suggestions" class="absolute z-10 mt-1 hidden w-full rounded-2xl border border-slate-200 bg-white shadow-md"></div>
          </div>

          <div id="component-service-checkboxes" class="grid gap-2 sm:grid-cols-2">
            @foreach($baseServices as $baseService)
              <label data-service-item data-service-name="{{ strtolower($baseService->service_name) }}" class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                <input
                  type="checkbox"
                  data-service-checkbox
                  name="component_service_ids[]"
                  value="{{ $baseService->id }}"
                  {{ in_array($baseService->id, $oldSelectedComponents) ? 'checked' : '' }}
                  class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500"
                />
                <span>{{ $baseService->service_name }}</span>
              </label>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  @endif

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Service</button>
</div>

@if($isPromoForm && $baseServices->isNotEmpty())
  <script>
    (() => {
      const services = @json($serviceOptions);
      const searchInput = document.getElementById('component-service-search');
      const suggestionsBox = document.getElementById('component-service-suggestions');
      const checkboxesContainer = document.getElementById('component-service-checkboxes');
      const serviceItems = [...checkboxesContainer.querySelectorAll('[data-service-item]')];

      const filterCheckboxList = (query) => {
        const keyword = query.trim().toLowerCase();
        serviceItems.forEach((item) => {
          const name = item.getAttribute('data-service-name') || '';
          const matches = name.includes(keyword);
          item.hidden = keyword && !matches;
        });
      };

      const renderSuggestions = (query) => {
        const keyword = query.trim().toLowerCase();
        const topMatches = services
          .filter(service => service.service_name.toLowerCase().includes(keyword))
          .slice(0, 3);

        if (!topMatches.length) {
          suggestionsBox.classList.add('hidden');
          suggestionsBox.innerHTML = '';
          return;
        }

        suggestionsBox.innerHTML = topMatches
          .map(service => `<button type="button" data-pick-id="${service.id}" class="block w-full border-b border-slate-100 px-4 py-2 text-left text-sm text-slate-700 last:border-b-0 hover:bg-slate-50">${service.service_name}</button>`)
          .join('');
        suggestionsBox.classList.remove('hidden');
      };

      searchInput.addEventListener('input', (event) => {
        const value = event.target.value;
        filterCheckboxList(value);
        renderSuggestions(value);
      });

      suggestionsBox.addEventListener('click', (event) => {
        const button = event.target.closest('[data-pick-id]');
        if (!button) return;
        const id = Number(button.getAttribute('data-pick-id'));
        const checkbox = checkboxesContainer.querySelector(`input[data-service-checkbox][value="${id}"]`);
        if (checkbox) checkbox.checked = true;
        searchInput.value = '';
        filterCheckboxList('');
        suggestionsBox.classList.add('hidden');
        suggestionsBox.innerHTML = '';
      });

      document.addEventListener('click', (event) => {
        if (!suggestionsBox.contains(event.target) && event.target !== searchInput) {
          suggestionsBox.classList.add('hidden');
        }
      });

      filterCheckboxList('');
    })();
  </script>
@endif
