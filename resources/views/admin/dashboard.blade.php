@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-3xl font-semibold text-slate-900">Dashboard</h1>
      <p class="mt-2 text-sm text-slate-600">Admin overview for revenue, stylists, and customers.</p>
    </div>
    <div class="flex flex-wrap gap-2">
      <a href="{{ route('admin.services.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Services</a>
      <a href="{{ route('admin.stylists.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Stylists</a>
      <a href="{{ route('admin.appointments.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Appointments</a>
    </div>
  </div>

  @include('admin.partials.alerts')

  <div class="grid gap-5 lg:grid-cols-3 mb-6 animate-fadeIn">
    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Revenue (done)</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900 animate-pulse-slow">₱{{ number_format($revenue, 2) }}</p>
    </article>

    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Estimated Monthly Income</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900 animate-pulse-slow">₱{{ number_format($estimatedMonthly, 2) }}</p>
    </article>

    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg">
      <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Total Customers</p>
      <p class="mt-4 text-4xl font-semibold text-slate-900 animate-pulse-slow">{{ $totalCustomers }}</p>
    </article>
  </div>

  <div class="grid gap-5 lg:grid-cols-2 mb-6">
    <!-- Top 3 Stylists -->
    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm animate-slideInLeft">
      <h2 class="mb-4 text-xl font-semibold text-slate-900">Top 3 Stylists</h2>
      <div class="space-y-3">
        @forelse($topStylists as $index => $stylist)
          <div class="flex items-center gap-4 p-3 rounded-lg bg-slate-50 hover:bg-slate-100 transition-colors duration-200">
            <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-yellow-400' : ($index === 1 ? 'bg-gray-300' : 'bg-orange-400') }} text-white font-semibold text-sm">
              #{{ $index + 1 }}
            </div>
            <div class="flex-1">
              <p class="font-semibold text-slate-900">{{ $stylist->name }}</p>
              <p class="text-sm text-slate-600">{{ $stylist->completed_appointments }} completed appointments</p>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-600">No stylists yet.</p>
        @endforelse
      </div>
    </article>

    <!-- Monthly Income Chart -->
    <article class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm animate-slideInRight">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-slate-900">Monthly Income</h2>
        <select id="year-filter" class="rounded-lg border border-slate-300 bg-slate-50 px-3 py-1 text-sm outline-none focus:border-slate-900" onchange="location.href='?year=' + this.value">
          @for($y = now()->year - 2; $y <= now()->year; $y++)
            <option value="{{ $y }}" {{ $y === $year ? 'selected' : '' }}>{{ $y }}</option>
          @endfor
        </select>
      </div>
      
      <div style="height: 300px;">
        <canvas id="monthlyIncomeChart"></canvas>
      </div>
    </article>
  </div>

  <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm animate-slideInUp">
    <h2 class="mb-4 text-xl font-semibold text-slate-900">Active Stylists</h2>
    <p class="text-4xl font-semibold text-slate-900">{{ $activeStylists }}</p>
  </div>

  <!-- Include Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const monthlyData = @json($monthlyIncomeData);
      const ctx = document.getElementById('monthlyIncomeChart');
      
      if (ctx) {
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: monthlyData.map(d => d.label),
            datasets: [{
              label: 'Monthly Income',
              data: monthlyData.map(d => d.income),
              borderColor: 'rgb(15, 23, 42)',
              backgroundColor: 'rgba(15, 23, 42, 0.1)',
              borderWidth: 2,
              fill: true,
              tension: 0.4,
              pointRadius: 6,
              pointBackgroundColor: 'rgb(15, 23, 42)',
              pointBorderColor: 'white',
              pointBorderWidth: 2,
              pointHoverRadius: 8,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: true,
                position: 'top',
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  callback: function(value) {
                    return '₱' + value.toLocaleString();
                  }
                }
              }
            }
          }
        });
      }
    });
  </script>

  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fadeIn {
      animation: fadeIn 0.6s ease-out;
    }

    .animate-slideInLeft {
      animation: slideInLeft 0.6s ease-out;
    }

    .animate-slideInRight {
      animation: slideInRight 0.6s ease-out;
    }

    .animate-slideInUp {
      animation: slideInUp 0.6s ease-out;
    }

    .animate-pulse-slow {
      animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: 0.9;
      }
    }
  </style>
@endsection
