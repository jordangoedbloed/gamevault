<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-zinc-100 font-semibold text-xl tracking-tight">Dashboard</div>
                <div class="text-sm text-zinc-400 mt-1">
                    Welkom terug, {{ auth()->user()->name }}.
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <span class="badge badge-live">Admin</span>
            @else
                <span class="badge">User</span>
            @endif
        </div>
    </x-slot>

    <div class="container-page section">
        {{-- Quick actions --}}
        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('games.index') }}" class="card hover:bg-white/5 transition">
                <div class="card-body">
                    <div class="text-zinc-100 font-semibold">Browse Games</div>
                    <div class="muted mt-1">
                        Bekijk de game library, filter op genre/platform en open details.
                    </div>
                    <div class="mt-4">
                        <span class="btn btn-muted">Naar Games →</span>
                    </div>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" class="card hover:bg-white/5 transition">
                <div class="card-body">
                    <div class="text-zinc-100 font-semibold">Profiel</div>
                    <div class="muted mt-1">
                        Pas je naam, e-mail en wachtwoord aan in je account.
                    </div>
                    <div class="mt-4">
                        <span class="btn btn-muted">Naar Profiel →</span>
                    </div>
                </div>
            </a>

            <div class="card">
                <div class="card-body">
                    <div class="text-zinc-100 font-semibold">Account status</div>
                    <div class="muted mt-1">
                        Je bent ingelogd en je e-mail is geverifieerd.
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="badge badge-live">Authenticated</span>
                        <span class="badge badge-live">Verified</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button class="btn btn-danger">Uitloggen</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Admin section --}}
        @if(auth()->user()->role === 'admin')
            <div class="mt-8">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="h2">Admin tools</h2>
                    <span class="muted">Beheer en moderatie</span>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <a href="{{ route('admin.games.index') }}" class="card hover:bg-white/5 transition">
                        <div class="card-body">
                            <div class="text-zinc-100 font-semibold">Manage Games</div>
                            <div class="muted mt-1">
                                Zet games actief/uit en markeer featured via POST actions.
                            </div>
                            <div class="mt-4">
                                <span class="btn btn-primary">Naar Admin · Games</span>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.dashboard') }}" class="card hover:bg-white/5 transition">
                        <div class="card-body">
                            <div class="text-zinc-100 font-semibold">Admin Dashboard</div>
                            <div class="muted mt-1">
                                Overzicht van beheerdersfunctionaliteit binnen GameVault.
                            </div>
                            <div class="mt-4">
                                <span class="btn btn-muted">Open →</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>