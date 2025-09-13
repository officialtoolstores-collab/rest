<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Відновлення пароля</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container" style="max-width:480px">
  <h1 class="mb-3">Забули пароль?</h1>
  <p class="text-muted">Введіть email — ми надішлемо посилання для скидання пароля.</p>

  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
    </div>
    <button class="btn btn-primary w-100">Надіслати посилання</button>
  </form>

  <div class="mt-3 d-flex gap-3">
    <a href="{{ route('login') }}">Повернутися до входу</a>
    <a href="{{ route('register') }}">Зареєструватися</a>
  </div>
</div>
</body></html>
