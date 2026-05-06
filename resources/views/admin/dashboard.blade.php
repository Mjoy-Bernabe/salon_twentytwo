@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
  <!-- Header Section -->
  <div class="mb-10">
    <h1 class="text-4xl font-bold text-white mb-2">Dashboard</h1>
    <p class="text-[#B0B0B0]">Welcome back. Here's your salon performance at a glance.</p>
  </div>

  @include('admin.partials.alerts')

  <!-- Key Metrics Grid -->
  <div class="grid gap-6 lg:grid-cols-3 mb-10">
    <!-- Revenue Card -->
    <article class="card rounded-xl p-8">
      <div class="flex items-center justify-between mb-4">
        <p class="text-xs uppercase tracking-wider text-[#B0B0B0] font-medium">Total Revenue</p>
        <div class="w-10 h-10 bg-[#CA8A04] bg-opacity-10 rounded-lg flex items-center justify-center">
          <svg class="w-5 h-5 text-[#CA8A04]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
      <p class="text-3xl font-bold text-white">₱{{ number_format($revenue, 2) }}</p>
      <p class="text-xs text-[#B0B0B0] mt-3">Completed appointments</p>
    </article>

    <!-- Active Stylists Card -->
    <article class="card rounded-xl p-8">
      <div class="flex items-center justify-between mb-4">
        <p class="text-xs uppercase tracking-wider text-[#B0B0B0] font-medium">Active Stylists</p>
        <div class="w-10 h-10 bg-[#CA8A04] bg-opacity-10 rounded-lg flex items-center justify-center">
          <svg class="w-5 h-5 text-[#CA8A04]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.488M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a3 3 0 003-3v-2a3 3 0 00-3-3H3a3 3 0 00-3 3v2a3 3 0 003 3h3z" />
          </svg>
        </div>
      </div>
      <p class="text-3xl font-bold text-white">{{ $activeStylists }}</p>
      <p class="text-xs text-[#B0B0B0] mt-3">Team members</p>
    </article>

    <!-- Total Customers Card -->
    <article class="card rounded-xl p-8">
      <div class="flex items-center justify-between mb-4">
        <p class="text-xs uppercase tracking-wider text-[#B0B0B0] font-medium">Total Customers</p>
        <div class="w-10 h-10 bg-[#CA8A04] bg-opacity-10 rounded-lg flex items-center justify-center">
          <svg class="w-5 h-5 text-[#CA8A04]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L8.117 8.427M12 4.354l3.883 4.073M3.172 15.172h17.656M9 20h6" />
          </svg>
        </div>
      </div>
      <p class="text-3xl font-bold text-white">{{ $totalCustomers }}</p>
      <p class="text-xs text-[#B0B0B0] mt-3">Active clients</p>
    </article>
  </div>

  <!-- Main Content Grid -->
  <div class="grid gap-8 lg:grid-cols-3">
    <!-- Income Trend Section -->
    <section class="lg:col-span-2 card rounded-xl p-8">
      <div class="mb-8">
        <h2 class="text-xl font-bold text-white mb-1">Income Trend</h2>
        <p class="text-sm text-[#B0B0B0]">Analyze your revenue over time with detailed insights.</p>
      </div>

      <!-- Filters -->
      <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <div>
            <label class="block text-xs uppercase tracking-wider text-[#B0B0B0] font-medium mb-2">View Type</label>
            <select name="filter_type" id="filter_type" class="w-full bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg px-4 py-2 text-white text-sm focus:border-[#CA8A04] focus:outline-none transition">
              <option value="year" {{ $filterType === 'year' ? 'selected' : '' }}>Yearly</option>
              <option value="month" {{ $filterType === 'month' ? 'selected' : '' }}>Monthly</option>
            </select>
          </div>

          <div>
            <label class="block text-xs uppercase tracking-wider text-[#B0B0B0] font-medium mb-2">Year</label>
            <select name="year" class="w-full bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg px-4 py-2 text-white text-sm focus:border-[#CA8A04] focus:outline-none transition">
              @foreach($years as $optionYear)
                <option value="{{ $optionYear }}" {{ $year === $optionYear ? 'selected' : '' }}>{{ $optionYear }}</option>
              @endforeach
            </select>
          </div>

          <div id="month-select" class="{{ $filterType === 'month' ? '' : 'hidden' }}">
            <label class="block text-xs uppercase tracking-wider text-[#B0B0B0] font-medium mb-2">Month</label>
            <select name="month" class="w-full bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg px-4 py-2 text-white text-sm focus:border-[#CA8A04] focus:outline-none transition">
              @foreach($months as $key => $label)
                <option value="{{ $key }}" {{ $month === $key ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <button type="submit" class="btn-accent px-6 py-2 rounded-lg text-sm font-medium transition">Apply Filter</button>
      </form>

      <!-- Revenue Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <article class="bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg p-6">
          <p class="text-xs uppercase tracking-wider text-[#B0B0B0] font-medium mb-2">Selected Period</p>
          <p class="text-2xl font-bold text-white">₱{{ number_format($selectedRevenue, 2) }}</p>
          <p class="text-xs text-[#B0B0B0] mt-2">Income for selected period</p>
        </article>
        <article class="bg-[#0A0A0A] border border-[#CA8A04] border-opacity-50 rounded-lg p-6">
          <p class="text-xs uppercase tracking-wider text-[#CA8A04] font-medium mb-2">Est. Monthly</p>
          <p class="text-2xl font-bold text-[#CA8A04]">₱{{ number_format($estimatedMonthlyIncome, 2) }}</p>
          <p class="text-xs text-[#B0B0B0] mt-2">Projected monthly average</p>
        </article>
      </div>

      <!-- Chart -->
      <div class="bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg p-6">
        <canvas id="incomeChart" width="700" height="300"></canvas>
      </div>
    </section>

    <!-- Top Stylists Section -->
    <section class="card rounded-xl p-8 h-fit">
      <h2 class="text-xl font-bold text-white mb-1">Top Performers</h2>
      <p class="text-sm text-[#B0B0B0] mb-6">Stylists with most completed appointments.</p>
      
      <div class="space-y-4">
        @foreach($topStylists as $index => $stylist)
          <div class="bg-[#0A0A0A] border border-[#2A2A2A] rounded-lg p-4 hover:border-[#CA8A04] transition">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#CA8A04] bg-opacity-20 rounded-full flex items-center justify-center text-[#CA8A04] font-bold text-sm">
                  #{{ $index + 1 }}
                </div>
                <div>
                  <p class="text-sm font-medium text-white">{{ $stylist->name }}</p>
                </div>
              </div>
              <div class="bg-[#CA8A04] bg-opacity-10 px-2 py-1 rounded text-xs font-semibold text-[#CA8A04]">
                {{ $stylist->appointments_count }}
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <a href="{{ route('admin.stylists.index') }}" class="btn-primary w-full mt-6 px-4 py-2 text-center rounded-lg text-sm font-medium transition">View All Stylists</a>
    </section>
  </div>

  <script>
    document.getElementById('filter_type').addEventListener('change', function () {
      const monthSelect = document.getElementById('month-select');
      monthSelect.classList.toggle('hidden', this.value !== 'month');
    });

    const labels = @json($chartLabels);
    const values = @json($chartValues);
    const canvas = document.getElementById('incomeChart');
    const ctx = canvas.getContext('2d');
    const padding = 50;
    const width = canvas.width - padding * 2;
    const height = canvas.height - padding * 2;
    const maxValue = Math.max(...values, 1);
    const pointRadius = 5;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold 12px -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
    ctx.strokeStyle = '#2A2A2A';
    ctx.lineWidth = 1;

    // Grid lines
    for (let i = 0; i <= 4; i++) {
      const y = padding + (height / 4) * i;
      ctx.strokeStyle = '#2A2A2A';
      ctx.beginPath();
      ctx.moveTo(padding, y);
      ctx.lineTo(canvas.width - padding, y);
      ctx.stroke();

      // Y-axis labels
      const value = Math.round((maxValue / 4) * (4 - i));
      ctx.fillStyle = '#B0B0B0';
      ctx.font = '11px -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
      ctx.textAlign = 'right';
      ctx.fillText('₱' + value.toLocaleString(), padding - 10, y + 4);
    }

    const points = labels.map((label, index) => {
      const x = padding + (width / Math.max(labels.length - 1, 1)) * index;
      const y = padding + height - (values[index] / maxValue) * height;
      return { x, y };
    });

    // Draw chart line
    ctx.strokeStyle = '#CA8A04';
    ctx.lineWidth = 2.5;
    ctx.beginPath();
    points.forEach((point, index) => {
      if (index === 0) {
        ctx.moveTo(point.x, point.y);
      } else {
        ctx.lineTo(point.x, point.y);
      }
    });
    ctx.stroke();

    // Fill area under curve
    ctx.fillStyle = 'rgba(202, 138, 4, 0.1)';
    ctx.beginPath();
    points.forEach((point, index) => {
      if (index === 0) {
        ctx.moveTo(point.x, point.y);
      } else {
        ctx.lineTo(point.x, point.y);
      }
    });
    ctx.lineTo(points[points.length - 1].x, canvas.height - padding);
    ctx.lineTo(points[0].x, canvas.height - padding);
    ctx.closePath();
    ctx.fill();

    // Draw points
    ctx.fillStyle = '#CA8A04';
    points.forEach((point, index) => {
      ctx.beginPath();
      ctx.arc(point.x, point.y, 5, 0, Math.PI * 2);
      ctx.fill();
      
      // White inner point
      ctx.fillStyle = '#0A0A0A';
      ctx.beginPath();
      ctx.arc(point.x, point.y, 3, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = '#CA8A04';
    });

    // Draw X-axis labels
    labels.forEach((label, index) => {
      const point = points[index];
      ctx.fillStyle = '#B0B0B0';
      ctx.textAlign = 'center';
      ctx.font = '11px -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
      ctx.fillText(label, point.x, canvas.height - padding + 20);
    });
  </script>
@endsection
