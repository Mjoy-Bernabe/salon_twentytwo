@extends('admin.layouts.app')

@section('title', 'Edit Customer')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Edit Customer</h1>
      <p class="mt-2 text-sm text-slate-600">Update the customer profile and active status.</p>
    </div>
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.customers.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">Back to customers</a>
        <a href="{{ route('admin.customers.show', $customer) }}" class="rounded-full bg-slate-900 px-4 py-3 text-sm text-white hover:bg-slate-700">View History</a>
      </div>
    @csrf
    @method('PUT')

    <div class="grid gap-6 lg:grid-cols-2">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $customer->name) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Contact Number</label>
        <input type="text" name="contact_num" value="{{ old('contact_num', $customer->contact_num) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-900" />
      </div>
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Account Status</label>
        <select name="active" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-900">
          <option value="1" {{ old('active', $customer->active) ? 'selected' : '' }}>Active</option>
          <option value="0" {{ ! old('active', $customer->active) ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
    </div>

    <div>
      <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 text-sm text-white hover:bg-slate-700">Save changes</button>
    </div>
  </form>
@endsection
