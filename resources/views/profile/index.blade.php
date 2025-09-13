@extends('layouts.app', ['title' => 'Профіль'])
@section('content')
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
@endsection

</body></html>
