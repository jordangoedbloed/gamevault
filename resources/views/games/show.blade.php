<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-3xl font-semibold">{{ e($game->title) }}</h1>
        <p class="mt-3 text-gray-700 dark:text-gray-300">{{ e($game->description) }}</p>
        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Genres: {{ $game->genres->pluck('name')->join(', ') ?: '-' }} |
            Platforms: {{ $game->platforms->pluck('name')->join(', ') ?: '-' }}
        </p>

        {{-- Flash status --}}
        @if (session('status'))
            <div class="mt-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mt-4 p-3 rounded bg-red-100 text-red-800">
                <ul class="list-disc ps-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Speelsessie knop --}}
        <form method="POST" action="{{ route('playsessions.store', $game) }}" class="mt-6">
            @csrf
            <button class="underline">Ik heb vandaag gespeeld</button>
        </form>

        {{-- Review formulier --}}
        <div class="mt-8 border rounded p-4 bg-white dark:bg-gray-800">
            <h2 class="text-xl font-semibold mb-3">Schrijf een review</h2>
            <form method="POST" action="{{ route('reviews.store', $game) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm mb-1">Rating (1–5)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating') }}"
                           class="border px-3 py-2 rounded w-24">
                </div>
                <div>
                    <label class="block text-sm mb-1">Jouw review</label>
                    <textarea name="body" rows="4" class="border px-3 py-2 rounded w-full">{{ old('body') }}</textarea>
                </div>
                <button class="border px-4 py-2 rounded">Plaatsen</button>
            </form>
            <p class="text-xs text-gray-500 mt-2">
                Voorwaarde: je moet minstens 5 verschillende dagen gespeeld hebben voordat je een review mag plaatsen.
            </p>
        </div>

        {{-- Reviews lijst --}}
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-3">Reviews</h2>
            @forelse ($game->reviews()->latest()->get() as $rev)
                <div class="border rounded p-3 mb-3 bg-white dark:bg-gray-800">
                    <div class="text-sm text-gray-500">
                        {{ $rev->user->name }} · Rating: {{ $rev->rating }}/5 · {{ $rev->created_at->diffForHumans() }}
                    </div>
                    <p class="mt-2">{{ e($rev->body) }}</p>
                </div>
            @empty
                <p class="text-gray-600">Nog geen reviews.</p>
            @endforelse
        </div>

        <div class="mt-6">
            <a href="{{ route('games.index') }}" class="underline">← Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
