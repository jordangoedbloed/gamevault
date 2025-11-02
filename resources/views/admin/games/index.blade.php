<x-app-layout>
  <div class="container-page section">
    <h1 class="h1 mb-6">Admin · Games</h1>

    @if (session('status'))
      <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <form method="GET" class="card mb-4">
      <div class="card-body flex flex-wrap items-end gap-2">
        <div class="w-full sm:w-64">
          <label class="block text-sm text-zinc-300 mb-1">Zoek op titel</label>
          <input name="q" value="{{ $q ?? '' }}" class="input">
        </div>
        <button class="btn btn-primary">Zoek</button>
        <a href="{{ route('admin.games.index') }}" class="btn btn-muted">Reset</a>
      </div>
    </form>

    <div class="space-y-3">
      @forelse ($games as $g)
        <div class="card">
          <div class="card-body flex items-center justify-between gap-4">
            <div>
              <div class="text-zinc-100 font-semibold">{{ e($g->title) }}</div>
              <div class="muted mt-1">
                Actief:
                @if($g->is_active) <span class="badge badge-live">Ja</span> @else <span class="badge badge-off">Nee</span> @endif
                · Featured:
                @if($g->is_featured) <span class="badge badge-live">Ja</span> @else <span class="badge badge-off">Nee</span> @endif
                <span class="text-zinc-500 ms-2">#{{ $g->id }}</span>
              </div>
            </div>

            <div class="flex gap-2">
              <form method="POST" action="{{ route('admin.games.toggleActive', $g) }}">
                @csrf
                <button class="btn btn-muted">Toggle Active</button>
              </form>
              <form method="POST" action="{{ route('admin.games.toggleFeatured', $g) }}">
                @csrf
                <button class="btn btn-muted">Toggle Featured</button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <p class="muted">Geen games gevonden.</p>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $games->links() }}
    </div>
  </div>
</x-app-layout>
