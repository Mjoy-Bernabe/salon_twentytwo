<div class="space-y-5">
  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Customer</label>
    <select name="customer_id" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
      <option value="">Select a customer</option>
      @foreach($customers as $customer)
        <option value="{{ $customer->id }}" {{ old('customer_id', $appointment->customer_id ?? '') == $customer->id ? 'selected' : '' }}>{{ $customer->name }} ({{ $customer->email }})</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Stylist</label>
    <select name="stylist_id" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
      <option value="">Select a stylist</option>
      @foreach($stylists as $stylist)
        <option value="{{ $stylist->id }}" {{ old('stylist_id', $appointment->stylist_id ?? '') == $stylist->id ? 'selected' : '' }}>{{ $stylist->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="grid gap-6 lg:grid-cols-2">
    <div>
      <label class="mb-2 block text-sm font-medium text-slate-700">Appointment Date & Time</label>
      <input type="datetime-local" name="appointment_datetime" value="{{ old('appointment_datetime', isset($appointment) ? $appointment->appointment_datetime->format('Y-m-d\TH:i') : '') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
    </div>
    <div>
      <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
      <select name="status" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
        @foreach(['pending','confirmed','done','cancelled'] as $status)
          <option value="{{ $status }}" {{ old('status', $appointment->status ?? 'pending') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">Downpayment</label>
    <input type="number" step="0.01" name="downpayment_amount" value="{{ old('downpayment_amount', $appointment->downpayment_amount ?? 0) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900" />
  </div>

  <div>
    <p class="mb-2 text-sm font-medium text-slate-700">Selected services</p>
    <div class="grid gap-2 sm:grid-cols-2">
      @foreach($services as $service)
        <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
          <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" {{ in_array($service->id, old('service_ids', $selectedServices ?? [])) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
          <span>{{ $service->service_name }} — ₱{{ number_format($service->price, 2) }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Appointment</button>
</div>
