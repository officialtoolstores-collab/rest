<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Реєстрація</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container" style="max-width:480px">
  <h1 class="mb-3">Реєстрація</h1>
  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif
  <form method="POST" action="{{ route('register.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Ім’я</label>
      <input type="text" name="name" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Пароль</label>
      <input type="password" name="password" class="form-control" required autocomplete="new-password">
    </div>
    <div class="mb-3">
      <label class="form-label">Підтвердження пароля</label>
      <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
    </div>
    <button class="btn btn-success w-100">Зареєструватися</button>
  </form>
  <div class="mt-3">
    <a href="{{ route('login') }}">Вже маєш акаунт? Увійти</a>
  </div>
</div>
</body></html>
