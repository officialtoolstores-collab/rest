@extends('layouts.app')

@section('title', 'Профіль')

@section('content')
<div class="container py-4">
  <h1 class="h4 mb-4">Налаштування профілю</h1>

  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}" class="card p-3 shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Ім’я</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', $user->name) }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email', $user->email) }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <hr class="my-3">

    <div class="mb-3">
      <label class="form-label">Новий пароль <span class="text-muted">(необов’язково)</span></label>
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
      @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Підтвердження пароля</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="d-flex gap-2">
      <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Скасувати</a>
      <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>
  </form>
</div>
@endsection
