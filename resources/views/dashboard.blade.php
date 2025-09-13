<nav class="mb-4 d-flex gap-3 align-items-center">
  <span>Вітаю, {{ $user->name }}</span>

  {{-- Профіль (Jetstream/Fortify) --}}
  <a href="{{ route('profile.show') }}">Профіль</a>

  {{-- Вийти --}}
  <form method="POST" action="{{ route('logout') }}" class="d-inline">
      @csrf
      <button type="submit">Вийти</button>
  </form>
</nav>
