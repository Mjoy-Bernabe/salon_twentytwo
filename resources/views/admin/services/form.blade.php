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

  <div class="flex items-center gap-3">
    <input id="is_promo" type="checkbox" name="is_promo" value="1" {{ old('is_promo', $service->is_promo ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
    <label for="is_promo" class="text-sm text-slate-700">Promo bundle</label>
  </div>

  <div id="promo-components" class="{{ old('is_promo', $service->is_promo ?? false) ? '' : 'hidden' }} space-y-3 rounded-2xl border-2 border-emerald-300 bg-emerald-50 p-6 ring-2 ring-emerald-200">
    <p class="text-base font-semibold text-slate-900">⭐ Promo Components</p>
    <p class="text-sm text-slate-600">Choose the services included in this promo bundle.</p>
    
    <div class="mb-4 flex gap-2">
      <input 
        type="text" 
        id="promo-search" 
        placeholder="Search services to add..." 
        class="flex-1 rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
      />
      <button 
        type="button" 
        id="promo-add-btn" 
        class="rounded-2xl bg-emerald-500 px-5 py-3 text-white hover:bg-emerald-600 transition-colors"
      >Add</button>
    </div>

    <div id="selected-promo-services" class="mb-4 grid gap-2 sm:grid-cols-2">
      @foreach($selectedComponents ?? [] as $selectedId)
        @php
          $selectedService = collect($baseServices)->firstWhere('id', $selectedId);
        @endphp
        @if($selectedService)
          <div class="flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-100 px-4 py-3">
            <span class="font-medium text-emerald-900">{{ $selectedService->service_name }}</span>
            <button 
              type="button" 
              class="remove-promo-service text-emerald-700 hover:text-emerald-900 font-bold"
              data-service-id="{{ $selectedId }}"
            >
              ✕
            </button>
            <input type="hidden" name="component_service_ids[]" value="{{ $selectedId }}" class="promo-service-input" />
          </div>
        @endif
      @endforeach
    </div>

    <div id="promo-suggestions" class="mb-4 grid gap-2 sm:grid-cols-2"></div>

    <div class="grid gap-2 sm:grid-cols-2 opacity-50">
      @foreach($baseServices as $baseService)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3">
          <input type="checkbox" name="component_service_ids[]" value="{{ $baseService->id }}" {{ in_array($baseService->id, old('component_service_ids', $selectedComponents ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500 promo-checkbox" data-service-id="{{ $baseService->id }}" data-service-name="{{ $baseService->service_name }}" />
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
    togglePromoSection();

    // Promo component search functionality
    const promoSearch = document.getElementById('promo-search');
    const promoAddBtn = document.getElementById('promo-add-btn');
    const suggestionsDiv = document.getElementById('promo-suggestions');
    const selectedServicesDiv = document.getElementById('selected-promo-services');
    const allServices = Array.from(document.querySelectorAll('.promo-checkbox')).map(cb => ({
      id: cb.dataset.serviceId,
      name: cb.dataset.serviceName
    }));

    function getSelectedPromoServiceIds() {
      return Array.from(document.querySelectorAll('.promo-service-input')).map(input => input.value);
    }

    function updatePromoSuggestions() {
      const query = promoSearch.value.toLowerCase();
      suggestionsDiv.innerHTML = '';

      if (!query) return;

      const selected = getSelectedPromoServiceIds();
      const suggestions = allServices.filter(s => 
        s.name.toLowerCase().includes(query) && !selected.includes(s.id)
      );

      suggestions.forEach(service => {
        const div = document.createElement('button');
        div.type = 'button';
        div.className = 'text-left rounded-2xl border border-emerald-300 bg-white px-4 py-3 hover:bg-emerald-50 transition-colors';
        div.textContent = service.name;
        div.onclick = (e) => {
          e.preventDefault();
          addPromoServiceToSelected(service.id, service.name);
          promoSearch.value = '';
          updatePromoSuggestions();
        };
        suggestionsDiv.appendChild(div);
      });
    }

    function addPromoServiceToSelected(serviceId, serviceName) {
      const selected = getSelectedPromoServiceIds();
      if (selected.includes(serviceId)) return;

      const div = document.createElement('div');
      div.className = 'flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-100 px-4 py-3';
      div.innerHTML = `
        <span class="font-medium text-emerald-900">${serviceName}</span>
        <button type="button" class="remove-promo-service text-emerald-700 hover:text-emerald-900 font-bold" data-service-id="${serviceId}">✕</button>
        <input type="hidden" name="component_service_ids[]" value="${serviceId}" class="promo-service-input" />
      `;

      div.querySelector('.remove-promo-service').onclick = (e) => {
        e.preventDefault();
        div.remove();
      };

      selectedServicesDiv.appendChild(div);

      // Update checkbox
      const checkbox = document.querySelector(`[data-service-id="${serviceId}"].promo-checkbox`);
      if (checkbox) checkbox.checked = true;
    }

    promoSearch.addEventListener('input', updatePromoSuggestions);
    promoAddBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const query = promoSearch.value.toLowerCase();
      if (!query) return;

      const selected = getSelectedPromoServiceIds();
      const matching = allServices.find(s => 
        s.name.toLowerCase() === query && !selected.includes(s.id)
      );

      if (matching) {
        addPromoServiceToSelected(matching.id, matching.name);
        promoSearch.value = '';
        updatePromoSuggestions();
      }
    });

    // Allow removing services by clicking the remove button
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-promo-service')) {
        e.preventDefault();
        e.target.closest('div').remove();
      }
    });
  });
</script>
