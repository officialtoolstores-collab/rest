<!doctype html>
<html lang="uk"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Мій кабінет</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container">
  <h1 class="mb-3">Привіт, {{ auth()->user()->name ?? 'користувач' }} ������</h1>
  <p class="text-muted">Це ваш користувацький дашборд.</p>

  <div class="mt-4 d-flex gap-2">
    <a href="{{ url('/pricing') }}" class="btn btn-primary">Купити токени</a>
    <a href="{{ url('/admin') }}" class="btn btn-outline-dark">Перейти в адмін-панель</a>
  </div>
</div>
</body></html>
