<div class="space-y-5">
  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Stylist Name</label>
    <input type="text" name="name" value="{{ old('name', $stylist->name ?? '') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Contact Number</label>
    <input type="text" name="contact" value="{{ old('contact', $stylist->contact ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
    <input type="email" name="email" value="{{ old('email', $stylist->email ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <p class="mb-2 text-base font-semibold text-slate-900">⭐ Services handled by this stylist</p>
    
    <div class="mb-4 flex gap-2 rounded-2xl border-2 border-blue-300 bg-blue-50 p-4">
      <input 
        type="text" 
        id="service-search" 
        placeholder="Search and add services..." 
        class="flex-1 rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 font-medium"
      />
      <button 
        type="button" 
        id="add-service-btn" 
        class="rounded-2xl bg-blue-500 px-5 py-3 text-white hover:bg-blue-600 transition-colors font-semibold"
      >Add Service</button>
    </div>

    <div id="selected-services" class="mb-4 grid gap-2 sm:grid-cols-2">
      @foreach($selectedServices ?? [] as $selectedId)
        @php
          $selectedService = collect($services)->firstWhere('id', $selectedId);
        @endphp
        @if($selectedService)
          <div class="flex items-center justify-between rounded-2xl border border-blue-200 bg-blue-100 px-4 py-3">
            <span class="font-medium text-blue-900">{{ $selectedService->service_name }}</span>
            <button 
              type="button" 
              class="remove-service text-blue-700 hover:text-blue-900 font-bold"
              data-service-id="{{ $selectedId }}"
            >
              ✕
            </button>
            <input type="hidden" name="service_ids[]" value="{{ $selectedId }}" class="service-input" />
          </div>
        @endif
      @endforeach
    </div>

    <div id="service-suggestions" class="mb-4 grid gap-2 sm:grid-cols-2"></div>

    <div class="grid gap-2 sm:grid-cols-2 opacity-50">
      @foreach($services as $service)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" {{ in_array($service->id, old('service_ids', $selectedServices ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-500 focus:ring-blue-500 service-checkbox" data-service-id="{{ $service->id }}" data-service-name="{{ $service->service_name }}" />
          <span>{{ $service->service_name }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Stylist</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('service-search');
  const addBtn = document.getElementById('add-service-btn');
  const suggestionsDiv = document.getElementById('service-suggestions');
  const selectedServicesDiv = document.getElementById('selected-services');
  const allServices = Array.from(document.querySelectorAll('.service-checkbox')).map(cb => ({
    id: cb.dataset.serviceId,
    name: cb.dataset.serviceName
  }));

  function getSelectedServiceIds() {
    return Array.from(document.querySelectorAll('.service-input')).map(input => input.value);
  }

  function updateSuggestions() {
    const query = searchInput.value.toLowerCase();
    suggestionsDiv.innerHTML = '';

    if (!query) return;

    const selected = getSelectedServiceIds();
    const suggestions = allServices.filter(s => 
      s.name.toLowerCase().includes(query) && !selected.includes(s.id)
    );

    suggestions.forEach(service => {
      const div = document.createElement('button');
      div.type = 'button';
      div.className = 'text-left rounded-2xl border border-slate-300 bg-white px-4 py-3 hover:bg-slate-50';
      div.textContent = service.name;
      div.onclick = (e) => {
        e.preventDefault();
        addServiceToSelected(service.id, service.name);
        searchInput.value = '';
        updateSuggestions();
      };
      suggestionsDiv.appendChild(div);
    });
  }

  function addServiceToSelected(serviceId, serviceName) {
    const selected = getSelectedServiceIds();
    if (selected.includes(serviceId)) return;

    const div = document.createElement('div');
    div.className = 'flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3';
    div.innerHTML = `
      <span>${serviceName}</span>
      <button type="button" class="remove-service text-emerald-700 hover:text-emerald-900" data-service-id="${serviceId}">✕</button>
      <input type="hidden" name="service_ids[]" value="${serviceId}" class="service-input" />
    `;

    div.querySelector('.remove-service').onclick = (e) => {
      e.preventDefault();
      div.remove();
    };

    selectedServicesDiv.appendChild(div);

    // Update checkbox
    const checkbox = document.querySelector(`[data-service-id="${serviceId}"]`);
    if (checkbox) checkbox.checked = true;
  }

  searchInput.addEventListener('input', updateSuggestions);
  addBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const query = searchInput.value.toLowerCase();
    if (!query) return;

    const selected = getSelectedServiceIds();
    const matching = allServices.find(s => 
      s.name.toLowerCase() === query && !selected.includes(s.id)
    );

    if (matching) {
      addServiceToSelected(matching.id, matching.name);
      searchInput.value = '';
      updateSuggestions();
    }
  });

  // Allow removing services by clicking the remove button
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-service')) {
      e.preventDefault();
      e.target.closest('div').remove();
    }
  });
});
</script>
