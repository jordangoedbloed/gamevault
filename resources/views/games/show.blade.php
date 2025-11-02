<x-app-layout>
  <div class="container-page section">
    <h1 class="h1">{{ e($game->title) }}</h1>
    <p class="muted mt-2">{{ e($game->description) }}</p>
    <p class="muted mt-2">
      Genres: {{ $game->genres->pluck('name')->join(', ') ?: '-' }} ·
      Platforms: {{ $game->platforms->pluck('name')->join(', ') ?: '-' }}
    </p>

    @if (session('status'))
      <div class="alert alert-success mt-4">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-error mt-4">
        <ul class="list-disc ps-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('playsessions.store', $game) }}" class="mt-6">
      @csrf
      <button class="btn btn-muted">Ik heb vandaag gespeeld</button>
    </form>

    <div class="card mt-8">
      <div class="card-body">
        <h2 class="h2 mb-3">Schrijf een review</h2>
        <form method="POST" action="{{ route('reviews.store', $game) }}" class="grid gap-3">
          @csrf
          <div>
            <label class="block text-sm text-zinc-300 mb-1">Rating (1–5)</label>
            <input type="number" name="rating" min="1" max="5" value="{{ old('rating') }}" class="input w-28">
          </div>
          <div>
            <label class="block text-sm text-zinc-300 mb-1">Jouw review</label>
            <textarea name="body" rows="4" class="textarea">{{ old('body') }}</textarea>
          </div>
          <div class="flex gap-2">
            <button class="btn btn-primary">Plaatsen</button>
          </div>
        </form>
        <p class="muted mt-2">
          Voorwaarde: je moet minstens <strong>1 keer</strong> hebben gespeeld voordat je een review mag plaatsen.
        </p>
      </div>
    </div>

    <div class="mt-8">
      <h2 class="h2 mb-3">Reviews</h2>
      @forelse ($game->reviews()->with('user')->latest()->get() as $rev)
        <div class="card mb-3">
          <div class="card-body">
            <div class="text-sm text-subtle">
              {{ $rev->user->name }} · Rating: {{ $rev->rating }}/5 · {{ $rev->created_at->diffForHumans() }}
            </div>
            <p class="mt-2 review-body">{{ e($rev->body) }}</p>

            @if (auth()->check() && auth()->id() === $rev->user_id)
              <details class="mt-3">
                <summary class="cursor-pointer text-sm underline text-zinc-300">Bewerk mijn review</summary>
                <form method="POST" action="{{ route('reviews.update', $rev) }}" class="mt-2 grid gap-2">
                  @csrf @method('PATCH')
                  <div>
                    <label class="block text-xs text-zinc-400">Rating (1–5)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $rev->rating) }}" class="input w-24">
                  </div>
                  <div>
                    <label class="block text-xs text-zinc-400">Review</label>
                    <textarea name="body" rows="3" class="textarea">{{ old('body', $rev->body) }}</textarea>
                  </div>
                  <div class="flex gap-2">
                    <button class="btn btn-primary">Opslaan</button>
                    <form method="POST" action="{{ route('reviews.destroy', $rev) }}" onsubmit="return confirm('Weet je zeker dat je je review wilt verwijderen?');">
                      @csrf @method('DELETE')
                      <button class="btn btn-danger">Verwijderen</button>
                    </form>
                  </div>
                </form>
              </details>
            @elseif (auth()->check() && auth()->user()->role === 'admin')
              <form method="POST" action="{{ route('reviews.destroy', $rev) }}" class="mt-3"
                    onsubmit="return confirm('Deze review als admin verwijderen?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Verwijderen (admin)</button>
              </form>
            @endif
          </div>
        </div>
      @empty
        <p class="muted">Nog geen reviews.</p>
      @endforelse
    </div>

    <div class="mt-6">
      <a href="{{ route('games.index') }}" class="text-zinc-300 hover:underline">← Terug naar overzicht</a>
    </div>
  </div>
</x-app-layout>
