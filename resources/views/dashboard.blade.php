{{-- resources/views/dashboard.blade.php --}}
<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title>Кабінет</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- Bootstrap 5 з CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Chart.js з CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
    .stat { border-radius: .75rem; }
  </style>
</head>
<body class="bg-light">
<div class="container py-4">
  {{-- Навігація --}}
  <nav class="d-flex justify-content-between align-items-center mb-4">
    <div class="fw-semibold">Вітаю, {{ $user->name }}</div>
    <div class="d-flex gap-2">
      <a class="btn btn-outline-secondary" href="{{ route('profile.show') }}">Профіль</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger" type="submit">Вийти</button>
      </form>
    </div>
  </nav>

  {{-- Статистика зверху --}}
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="bg-white shadow-sm p-3 stat">
        <div class="text-muted small">Баланс (USDT)</div>
        <div class="h4 m-0">{{ number_format($balanceUsdt, 2) }}</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="bg-white shadow-sm p-3 stat">
        <div class="text-muted small">Залишок токенів</div>
        <div class="h4 m-0">{{ number_format($tokensLeft) }}</div>
      </div>
    </div>
    <div class="col-md-4">
      <a href="{{ route('billing.topup') }}" class="btn btn-success w-100 h-100 d-flex align-items-center justify-content-center stat">
        Поповнити баланс
      </a>
    </div>
  </div>

  {{-- Графік використання токенів --}}
  <div class="bg-white shadow-sm p-3 mb-4 stat">
    <div class="d-flex justify-content-between align-items-center">
      <div class="fw-semibold">Використання токенів (останні 30 днів)</div>
      <div class="text-muted small">сума за день</div>
    </div>
    <canvas id="usageChart" height="100"></canvas>
  </div>

  {{-- Таблиця останніх використань --}}
  <div class="bg-white shadow-sm p-3 stat">
    <div class="fw-semibold mb-3">Останні операції</div>
    <div class="table-responsive">
      <table class="table table-sm align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Дія</th>
            <th class="text-end">Токенів</th>
            <th>Коли</th>
          </tr>
        </thead>
        <tbody>
        @forelse(($usages ?? collect()) as $i => $u)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td><code>{{ $u->action }}</code></td>
            <td class="text-end">{{ $u->tokens }}</td>
            <td>{{ \Carbon\Carbon::parse($u->created_at)->format('Y-m-d H:i') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-muted">Поки що записів нема.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
const labels = @json($chartLabels ?? []);
const data    = @json($chartData ?? []);
const ctx = document.getElementById('usageChart');
if (ctx && labels.length) {
  new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: 'Токени/доба',
        data,
        tension: 0.35
      }]
    },
    options: {
      responsive: true,
      interaction: { mode: 'index', intersect: false },
      scales: {
        x: { ticks: { autoSkip: true, maxTicksLimit: 10 } },
        y: { beginAtZero: true, ticks: { precision: 0 } }
      }
    }
  });
}
</script>
</body>
</html>
