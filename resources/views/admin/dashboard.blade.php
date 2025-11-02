<x-app-layout>
  <div class="container-page section">
    <h1 class="h1 mb-4">Dashboard</h1>
    <div class="card">
      <div class="card-body">
        <p class="muted">Welkom terug, {{ auth()->user()->name }}.</p>
        @if(auth()->user()->role === 'admin')
          <p class="mt-3">
            <a class="btn btn-primary" href="{{ route('admin.games.index') }}">Naar Admin · Games</a>
          </p>
        @else
          <p class="mt-3">
            <a class="btn btn-primary" href="{{ route('games.index') }}">Bekijk Games</a>
          </p>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>
