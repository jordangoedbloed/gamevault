<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4">Admin · Games</h1>

        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" class="mb-4 flex gap-2">
            <input name="q" value="{{ $q ?? '' }}" placeholder="Zoek op titel" class="border px-3 py-2 rounded w-64">
            <button class="border px-4 py-2 rounded">Zoek</button>
            <a href="{{ route('admin.games.index') }}" class="underline self-center">Reset</a>
        </form>

        <div class="space-y-2">
            @forelse ($games as $g)
                <div class="flex items-center justify-between border rounded p-3 bg-white dark:bg-gray-800">
                    <div>
                        <div class="font-semibold">{{ e($g->title) }}</div>
                        <div class="text-xs text-gray-600 dark:text-gray-300">
                            Actief: <strong>{{ $g->is_active ? 'Ja' : 'Nee' }}</strong> ·
                            Featured: <strong>{{ $g->is_featured ? 'Ja' : 'Nee' }}</strong>
                            <span class="ml-2 text-gray-400">#{{ $g->id }}</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('admin.games.toggleActive', $g) }}">
                            @csrf
                            <button type="submit" class="text-sm border px-3 py-1 rounded">
                                Toggle Active
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.games.toggleFeatured', $g) }}">
                            @csrf
                            <button type="submit" class="text-sm border px-3 py-1 rounded">
                                Toggle Featured
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Geen games gevonden.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $games->links() }}
        </div>
    </div>
</x-app-layout>
