<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-3xl font-semibold">{{ e($game->title) }}</h1>
        <p class="mt-3 text-gray-700 dark:text-gray-300">{{ e($game->description) }}</p>
        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Genres: {{ $game->genres->pluck('name')->join(', ') ?: '-' }} |
            Platforms: {{ $game->platforms->pluck('name')->join(', ') ?: '-' }}
        </p>
        <div class="mt-6">
            <a href="{{ route('games.index') }}" class="underline">← Terug naar overzicht</a>
        </div>
    </div>
</x-app-layout>
