<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin - PC Shop')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">

    <div class="min-h-screen flex">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col">
            <div class="px-5 py-4 border-b border-slate-800">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-lg font-extrabold text-brand-500">PC Shop</span>
                    <span class="text-xs px-2 py-0.5 rounded-full bg-slate-800 text-slate-200">Admin</span>
                </a>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                <a href="{{ route('admin.products.index') }}"
                    class="block px-3 py-2 rounded-xl transition
           {{ request()->routeIs('admin.products.*')
               ? 'bg-slate-800 text-brand-400'
               : 'text-slate-200 hover:bg-slate-800/70' }}">
                    Produits
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="block px-3 py-2 rounded-xl transition
           {{ request()->routeIs('admin.categories.*')
               ? 'bg-slate-800 text-brand-400'
               : 'text-slate-200 hover:bg-slate-800/70' }}">
                    Catégories
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="block px-3 py-2 rounded-xl transition
           {{ request()->routeIs('admin.orders.*')
               ? 'bg-slate-800 text-brand-400'
               : 'text-slate-200 hover:bg-slate-800/70' }}">
                    Commandes
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-slate-800 text-xs text-slate-400 space-y-2">
                <div>
                    Connecté en tant que<br>
                    <span class="font-semibold text-slate-100">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('home') }}" class="hover:text-brand-400">Voir le site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="hover:text-red-400" type="submit">Déconnexion</button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- CONTENU --}}
        <main class="flex-1 flex flex-col">
            {{-- Header admin avec bouton dark/light --}}
            <header
                class="border-b border-slate-200 dark:border-slate-800 px-6 py-4 flex items-center justify-between bg-white/80 dark:bg-slate-950/80 backdrop-blur">
                <h1 class="text-lg font-semibold tracking-tight">
                    @yield('header', 'Tableau de bord')
                </h1>

                <button id="theme-toggle" type="button"
                    class="px-3 py-1.5 rounded-full border border-slate-300 text-xs text-slate-700 hover:bg-slate-100
                       dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800">
                    Mode sombre / clair
                </button>
            </header>

            <div class="p-6 flex-1">
                @if (session('success'))
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>
