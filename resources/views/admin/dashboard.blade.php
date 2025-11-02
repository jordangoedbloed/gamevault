<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-semibold mb-6">Admin Dashboard</h1>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <p class="text-gray-700 dark:text-gray-300">
                Welkom terug, <strong>{{ auth()->user()->name }}</strong>!
            </p>

            <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                Je bent ingelogd als <span class="font-semibold">{{ auth()->user()->role }}</span>.
            </p>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2">Beheer opties (voorbeeld)</h2>
            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300">
                <li>Game overzicht beheren</li>
                <li>Gebruikers controleren</li>
                <li>Recensies modereren</li>
                <li>Status toggles uitvoeren (actief/niet actief, featured)</li>
            </ul>
        </div>
    </div>
</x-app-layout>
