<x-app-layout>
  <div class="container-page section">
    <h1 class="h1 mb-6">Games</h1>

    @if (session('status'))
      <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <form method="GET" class="card mb-6">
      <div class="card-body grid gap-3 md:grid-cols-4">
        <input name="q" value="{{ $q }}" placeholder="Zoek in titel/omschrijving" class="input md:col-span-2">
        <select name="genre" class="select">
          <option value="">Alle genres</option>
          @foreach($genres as $genre)
            <option value="{{ $genre->id }}" @selected(request('genre')==$genre->id)>{{ $genre->name }}</option>
          @endforeach
        </select>
        <select name="platform" class="select">
          <option value="">Alle platforms</option>
          @foreach($platforms as $platform)
            <option value="{{ $platform->id }}" @selected(request('platform')==$platform->id)>{{ $platform->name }}</option>
          @endforeach
        </select>
        <div class="md:col-span-4 flex gap-2">
          <button class="btn btn-primary">Zoek</button>
          <a href="{{ route('games.index') }}" class="btn btn-muted">Reset</a>
        </div>
      </div>
    </form>

    <div class="grid md:grid-cols-3 gap-4">
      @foreach($games as $game)
        <div class="card">
          <div class="card-body">
            <div class="flex items-center justify-between">
              <a href="{{ route('games.show',$game) }}" class="text-zinc-100 font-semibold hover:underline">{{ e($game->title) }}</a>
              @if($game->is_featured)
                <span class="badge badge-live">Featured</span>
              @endif
            </div>
            <p class="text-subtle mt-1">
              Genres: {{ $game->genres->pluck('name')->join(', ') ?: '-' }} ·
              Platforms: {{ $game->platforms->pluck('name')->join(', ') ?: '-' }}
            </p>

            <form method="POST" action="{{ route('playsessions.store', $game) }}" class="mt-4">
              @csrf
              <button class="btn btn-muted">Ik heb vandaag gespeeld</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-6">
      {{ $games->links() }}
    </div>
  </div>
</x-app-layout>
