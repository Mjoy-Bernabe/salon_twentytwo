@extends('admin.layouts.app')

@section('title', 'Customers')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Customers</h1>
      <p class="mt-2 text-sm text-slate-600">Manage customers and view their appointment history.</p>
    </div>
  </div>

  @include('admin.partials.alerts')

  <div class="mb-6 rounded-[28px] bg-white p-6 shadow-sm">
    <form method="GET" action="{{ route('admin.customers.index') }}" id="filter-form" class="flex gap-4">
      <div class="flex-1">
        <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
        <select name="status" onchange="document.getElementById('filter-form').submit()" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900">
          <option value="">All Customers</option>
          <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
    </form>
  </div>

  <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-6 py-4 font-semibold text-slate-600">Name</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Email</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Contact</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Status</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Appointments</th>
          <th class="px-6 py-4 font-semibold text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-200 bg-white">
        @foreach($customers as $customer)
          <tr>
            <td class="px-6 py-4">{{ $customer->name }}</td>
            <td class="px-6 py-4">{{ $customer->email }}</td>
            <td class="px-6 py-4">{{ $customer->contact_num ?? '-' }}</td>
            <td class="px-6 py-4">
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer toggle-active-checkbox" data-customer-id="{{ $customer->id }}" {{ $customer->is_active ? 'checked' : '' }} />
                <div class="w-11 h-6 bg-rose-500 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
              </label>
            </td>
            <td class="px-6 py-4">{{ $customer->appointments_count ?? $customer->appointments()->count() }}</td>
            <td class="px-6 py-4 space-x-2">
              <a href="{{ route('admin.customers.show', $customer) }}" class="rounded-full bg-slate-900 px-3 py-2 text-xs text-white hover:bg-slate-700">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="border-t border-slate-200 bg-white px-6 py-4">
      {{ $customers->links() }}
    </div>
  </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
  const toggleCheckboxes = document.querySelectorAll('.toggle-active-checkbox');
  
  toggleCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', async function() {
      const customerId = this.dataset.customerId;
      
      try {
        const response = await fetch(`/admin/customers/${customerId}/toggle-active`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
          }
        });
        
        if (response.ok) {
          const data = await response.json();
          // Update the visual state
          const row = this.closest('tr');
          if (data.is_active) {
            this.checked = true;
          } else {
            this.checked = false;
          }
        }
      } catch (error) {
        console.error('Error toggling customer status:', error);
        this.checked = !this.checked; // Revert on error
      }
    });
  });
});
</script>
