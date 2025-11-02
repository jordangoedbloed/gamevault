<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4">Games</h1>

        {{-- Flash message --}}
        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" class="flex flex-wrap gap-2 mb-4">
            <input name="q" value="{{ $q }}" placeholder="Zoek in titel/omschrijving"
                   class="border px-3 py-2 rounded w-full md:w-64">
            <select name="genre" class="border px-3 py-2 rounded">
                <option value="">Alle genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @selected(request('genre')==$genre->id)>{{ $genre->name }}</option>
                @endforeach
            </select>
            <select name="platform" class="border px-3 py-2 rounded">
                <option value="">Alle platforms</option>
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}" @selected(request('platform')==$platform->id)>{{ $platform->name }}</option>
                @endforeach
            </select>
            <button class="border px-4 py-2 rounded">Zoek</button>
        </form>

        <div class="grid md:grid-cols-3 gap-4">
            @foreach($games as $game)
                <div class="border rounded p-4 bg-white dark:bg-gray-800">
                    <a href="{{ route('games.show',$game) }}" class="font-semibold">
                        {{ e($game->title) }}
                    </a>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Genres: {{ $game->genres->pluck('name')->join(', ') ?: '-' }}<br>
                        Platforms: {{ $game->platforms->pluck('name')->join(', ') ?: '-' }}
                    </p>

                    {{-- Speelsessie-knop: 1 per dag per user per game --}}
                    <form method="POST" action="{{ route('playsessions.store', $game) }}" class="mt-3">
                        @csrf
                        <button class="text-sm underline">Ik heb vandaag gespeeld</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $games->links() }}
        </div>
    </div>
</x-app-layout>
