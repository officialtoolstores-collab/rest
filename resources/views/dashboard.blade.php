<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    Привіт, {{ $user->name }}!
  </div>

  <div class="d-flex gap-3">
    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm">
      Налаштування профілю
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-outline-danger btn-sm">Вийти</button>
    </form>
  </div>
</div>
