<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Кабінет</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Привіт, {{ auth()->user()->name }} ��</h1>

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
<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Мій профіль</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container" style="max-width:720px">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Мій профіль</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">⬅ До кабінету</a>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}" class="card p-3 shadow-sm">
    @csrf

    <div class="mb-3">
      <label class="form-label">Ім’я</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Зберегти</button>
      <a class="btn btn-outline-secondary" href="{{ route('password.request') }}">Змінити пароль</a>
    </div>
  </form>
</div>
</body></html>
