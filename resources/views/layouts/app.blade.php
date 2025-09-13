<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- Bootstrap з CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f6f7fb; }
    .nav-link.active { font-weight:600; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="topnav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center gap-2">
        @auth
          <li class="nav-item">
            <a class="btn btn-outline-secondary" href="{{ route('profile.edit') }}">Профіль</a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Вийти</button>
            </form>
          </li>
        @endauth
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Увійти</a></li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
  {{-- флеші / помилки --}}
  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger mb-3">
      <div class="fw-semibold mb-1">Помилки:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
