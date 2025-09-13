<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Вхід</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container" style="max-width:480px">
  <h1 class="mb-3">Вхід</h1>
  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif
  <form method="POST" action="{{ route('login.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required autofocus autocomplete="username">
    </div>
    <div class="mb-3">
      <label class="form-label">Пароль</label>
      <input type="password" name="password" class="form-control" required autocomplete="current-password">
    </div>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" name="remember" id="remember">
      <label class="form-check-label" for="remember">Запам’ятати мене</label>
    </div>
    <button class="btn btn-primary w-100">Увійти</button>
  </form>
  <div class="d-flex justify-content-between mt-3">
    <a href="{{ route('register') }}">Реєстрація</a>
    <a href="{{ route('password.request') }}">Забули пароль?</a>
  </div>
</div>
</body></html>
