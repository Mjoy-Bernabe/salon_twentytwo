@if(session('success'))
  <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900">
    {{ session('success') }}
  </div>
@endif

@if($errors->any())
  <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
    <strong class="block font-semibold">There were some problems with your input.</strong>
    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
