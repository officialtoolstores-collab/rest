<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Кабінет</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Привіт, {{ auth()->user()->name }} ������</h1>

    <div class="d-flex gap-2">
      <a class="btn btn-outline-secondary" href="{{ route('profile.page') }}">Мій профіль</a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger" type="submit">Вийти</button>
      </form>
    </div>
  </div>

  {{-- Тут, якщо є баланс --}}
  {{-- <div class="alert alert-info">Ваш баланс токенів: {{ $balance ?? 0 }}</div> --}}

  <h2 class="h5 mt-4 mb-3">Використані токени</h2>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Дія</th>
          <th class="text-end">Токенів</th>
          <th>Коли</th>
        </tr>
      </thead>
      <tbody>
      @forelse($usages as $i => $u)
        <tr>
          <td>{{ $usages->firstItem() + $i }}</td>
          <td><code>{{ $u->action }}</code></td>
          <td class="text-end">{{ $u->tokens }}</td>
          <td>{{ $u->created_at->format('Y-m-d H:i') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-muted">Поки що записів нема.</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>

  {{ $usages->withQueryString()->links() }}
</div>
</body></html>
