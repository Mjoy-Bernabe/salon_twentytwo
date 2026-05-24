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
    <p class="mb-2 text-base font-semibold text-slate-900">Services handled by this stylist</p>

    <div class="mb-4 flex gap-2 rounded-2xl border border-slate-200 bg-slate-50 p-4">
      <input
        type="text"
        id="service-search"
        placeholder="Search services..."
        class="flex-1 rounded-2xl border border-slate-300 bg-white px-4 py-3 font-medium outline-none focus:border-slate-900"
      />
    </div>

    <div class="mb-4 rounded-2xl border border-slate-700 bg-slate-900 p-4">
      <p class="mb-3 text-sm font-semibold text-white">Selected Services</p>
      <div id="selected-services" class="grid gap-2 sm:grid-cols-2"></div>
      <p id="selected-empty" class="text-sm text-slate-300">No services selected yet.</p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-4">
      <p class="mb-3 text-sm font-semibold text-slate-700">Available Services</p>
      <div id="available-services" class="grid gap-2 sm:grid-cols-2">
        @foreach($services as $service)
          @php
            $checked = in_array($service->id, old('service_ids', $selectedServices ?? []));
          @endphp
          <label data-service-item data-service-name="{{ strtolower($service->service_name) }}" class="flex items-center justify-between gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
            <span class="flex items-center gap-2">
              <input
                type="checkbox"
                name="service_ids[]"
                value="{{ $service->id }}"
                {{ $checked ? 'checked' : '' }}
                class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 service-checkbox"
                data-service-id="{{ $service->id }}"
                data-service-name="{{ $service->service_name }}"
                data-is-promo="{{ $service->is_promo ? '1' : '0' }}"
              />
              <span>{{ $service->service_name }}</span>
            </span>
            @if($service->is_promo)
              <span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">PROMO</span>
            @endif
          </label>
        @endforeach
      </div>
    </div>
  </div>

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Stylist</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('service-search');
  const selectedServicesDiv = document.getElementById('selected-services');
  const selectedEmpty = document.getElementById('selected-empty');
  const serviceItems = Array.from(document.querySelectorAll('[data-service-item]'));
  const checkboxes = Array.from(document.querySelectorAll('.service-checkbox'));

  const escapeHtml = (value) => String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#39;');

  const renderSelected = () => {
    const selected = checkboxes.filter((cb) => cb.checked);
    selectedServicesDiv.innerHTML = '';

    selected.forEach((checkbox) => {
      const serviceName = checkbox.dataset.serviceName || '';
      const isPromo = checkbox.dataset.isPromo === '1';
      const serviceId = checkbox.dataset.serviceId;

      const row = document.createElement('div');
      row.className = 'flex items-center justify-between rounded-2xl border border-slate-600 bg-slate-800 px-4 py-3';
      row.innerHTML = `
        <div class="flex items-center gap-2">
          <span class="font-medium text-white">${escapeHtml(serviceName)}</span>
          ${isPromo ? '<span class="rounded-full bg-amber-400 px-2 py-1 text-xs font-semibold text-slate-900">PROMO</span>' : ''}
        </div>
        <button type="button" data-remove-service="${serviceId}" class="text-sm font-semibold text-amber-300 hover:text-amber-200">Remove</button>
      `;
      selectedServicesDiv.appendChild(row);
    });

    selectedEmpty.classList.toggle('hidden', selected.length > 0);
  };

  const filterAvailable = () => {
    const query = searchInput.value.trim().toLowerCase();
    serviceItems.forEach((item) => {
      const name = item.getAttribute('data-service-name') || '';
      item.classList.toggle('hidden', Boolean(query) && !name.includes(query));
    });
  };

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', renderSelected);
  });

  selectedServicesDiv.addEventListener('click', (event) => {
    const btn = event.target.closest('[data-remove-service]');
    if (!btn) return;
    const id = btn.getAttribute('data-remove-service');
    const checkbox = document.querySelector(`.service-checkbox[data-service-id="${id}"]`);
    if (checkbox) {
      checkbox.checked = false;
      renderSelected();
    }
  });

  searchInput.addEventListener('input', filterAvailable);

  renderSelected();
});
</script>
