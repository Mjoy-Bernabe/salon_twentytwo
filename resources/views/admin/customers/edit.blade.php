@extends('admin.layouts.app')

@section('title', 'Edit Customer')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Edit Customer</h1>
      <p class="mt-2 text-sm text-slate-600">Update customer information and status.</p>
    </div>
    <a href="{{ route('admin.customers.show', $customer) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to Customer</a>
  </div>

  @include('admin.partials.alerts')

  <form method="POST" action="{{ route('admin.customers.update', $customer) }}" class="max-w-2xl rounded-[28px] bg-white p-6 shadow-sm">
    @csrf
    @method('PUT')

    <div class="space-y-5">
      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Full Name</label>
        <input type="text" name="name" value="{{ old('name', $customer->name) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900 @error('name') border-rose-500 @enderror" />
        @error('name')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900 @error('email') border-rose-500 @enderror" />
        @error('email')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Contact Number</label>
        <input type="text" name="contact_num" value="{{ old('contact_num', $customer->contact_num) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900 @error('contact_num') border-rose-500 @enderror" />
        @error('contact_num')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
        <select name="is_active" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-slate-900 @error('is_active') border-rose-500 @enderror">
          <option value="">Select status</option>
          <option value="1" {{ old('is_active', $customer->is_active ? '1' : '0') === '1' ? 'selected' : '' }}>Active</option>
          <option value="0" {{ old('is_active', $customer->is_active ? '1' : '0') === '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('is_active')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex gap-4">
        <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-white hover:bg-slate-700">Save Changes</button>
        <a href="{{ route('admin.customers.show', $customer) }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-slate-700 hover:bg-slate-50">Cancel</a>
      </div>
    </div>
  </form>
@endsection
