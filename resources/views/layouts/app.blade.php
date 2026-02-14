<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'PC Shop - E-commerce')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">

<header class="border-b border-slate-200 dark:border-slate-800">
    {{-- TOP BAR --}}
    <div class="bg-slate-100 dark:bg-slate-900 text-xs text-slate-600 dark:text-slate-300">
        <div class="max-w-7xl mx-auto px-4 py-1 flex items-center justify-between">
            <div class="flex items-center gap-2">
                {{-- <span class="inline-flex items-center justify-center w-5 h-5 rounded-full border border-slate-400 text-[10px]">PDF</span> --}}
                <span class="font-medium">Découvrez nos offres exclusives</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="#contact" class="hover:text-brand-600 hidden sm:inline-flex items-center gap-1">
                    <span>Contactez‑nous</span>
                </a>
                <span class="hidden sm:inline text-slate-500 dark:text-slate-400">
                    +212 694972457
                </span>
                {{-- <div class="hidden sm:flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <span class="text-xs">.</span>
                    <span class="text-xs">.</span>
                    <span class="text-xs">.</span>
                </div> --}}

                {{-- Toggle dark mode --}}
                <button
                    id="theme-toggle"
                    type="button"
                    class="px-2 py-1 rounded-full border border-slate-300 text-[11px] text-slate-700 hover:bg-slate-200 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700"
                >
                    Mode sombre
                </button>
            </div>
        </div>
    </div>

    {{-- HEADER PRINCIPAL : logo + recherche + icônes --}}
    <div class="bg-white dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-6">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-1">
                <span class="text-2xl font-extrabold text-brand-600">PC</span>
                <span class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Shop</span>
            </a>

            {{-- Barre de recherche large --}}
            <form action="{{ route('products.index') }}" method="GET" class="flex-1">
                <div class="flex items-center bg-slate-50 dark:bg-slate-900 border border-slate-400 dark:border-slate-700 rounded-full px-4 py-2">
                    <input
                        type="text"
                        name="q"
                        placeholder="Rechercher dans le catalogue"
                        value="{{ request('q') }}"
                        class="flex-1 bg-transparent border-0 text-sm outline-none focus:outline-none focus:ring-0 border-none"
                    >
                    <button type="submit" class="text-slate-500 hover:text-brand-600 text-sm font-medium">
                        Rechercher
                    </button>
                </div>
            </form>

            {{-- Compte / Panier --}}
            <div class="flex items-center gap-4 ml-auto">
                @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline text-xs text-slate-700 dark:text-slate-200 hover:text-brand-600">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:inline text-xs text-white bg-brand-600 hover:bg-brand-700 px-3 py-1.5 rounded-full">
                        Inscription
                    </a>
                @else
                    <a href="{{ route('account.index') }}" class="hidden sm:inline text-xs text-slate-700 dark:text-slate-200 hover:text-brand-600">
                        Mon compte
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-slate-500 hover:text-red-500">
                            Déconnexion
                        </button>
                    </form>
                @endguest

                {{-- Panier --}}
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center text-sm text-slate-700 dark:text-slate-200 hover:text-brand-600">
                    <span class="mr-1 font-semibold">Panier</span>
                    @php
                        $cart = session('cart', []);
                        $count = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    @if($count > 0)
                        <span class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-brand-600 text-white">
                            {{ $count }}
                        </span>
                    @endif
                </a>
            </div>

            {{-- Icônes compte / logout / panier --}}
            {{-- Icônes compte / logout / panier --}}
            <!-- <div class="flex items-center gap-2 ml-auto">
                @auth
                    {{-- Icône Mon compte --}}
                    <a
                        href="{{ route('account.index') }}"
                        aria-label="Mon compte"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-full border
                            border-slate-300/80 dark:border-slate-600 bg-white/90 dark:bg-slate-900/90
                            text-slate-700 dark:text-slate-100
                            hover:border-brand-500 hover:text-brand-500 shadow-sm transition"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4Z"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 20c0-2.2 2.7-4 6-4s6 1.8 6 4"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    {{-- Icône Déconnexion --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            aria-label="Déconnexion"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full border
                                border-slate-300/80 dark:border-slate-600 bg-white/90 dark:bg-slate-900/90
                                text-slate-700 dark:text-slate-100
                                hover:border-red-500 hover:text-red-500 shadow-sm transition"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17l5-5-5-5"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12H9"
                                    stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                @else
                    {{-- Icône compte (connexion) --}}
                    <a
                        href="{{ route('login') }}"
                        aria-label="Se connecter"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-full border
                            border-slate-300/80 dark:border-slate-600 bg-white/90 dark:bg-slate-900/90
                            text-slate-700 dark:text-slate-100
                            hover:border-brand-500 hover:text-brand-500 shadow-sm transition"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4Z"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 21v-1a4 4 0 0 1 4-4h2"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 17l5-5-5-5"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12H11"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                @endauth

                {{-- Icône Panier --}}
                @php
                    $cart = session('cart', []);
                    $count = array_sum(array_column($cart, 'quantity'));
                @endphp
                <a
                    href="{{ route('cart.index') }}"
                    aria-label="Panier ({{ $count }})"
                    class="relative inline-flex items-center justify-center w-9 h-9 rounded-full border
                        border-slate-300/80 dark:border-slate-600 bg-white/90 dark:bg-slate-900/90
                        text-slate-700 dark:text-slate-100
                        hover:border-brand-500 hover:text-brand-500 shadow-sm transition"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="21" r="1"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="20" cy="21" r="1"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 3h2l3.6 12.59A1 1 0 0 0 9.6 17h9.8a1 1 0 0 0 .98-.8L22 8H6"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    @if($count > 0)
                        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center
                                    min-w-[16px] h-4 px-1 rounded-full bg-brand-600 text-[10px] font-semibold text-white">
                            {{ $count }}
                        </span>
                    @endif
                </a>
            </div> -->
        </div>
    </div>

    {{-- NAV BLEUE --}}
    <nav class="bg-brand-600 text-white text-sm font-medium">
        <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 py-2">
            <a href="/catalogue" class="hover:bg-brand-700 px-3 py-1 rounded">
                Tous nos produits
            </a>
            <a href="#catalogue" class="hover:bg-brand-700 px-3 py-1 rounded">
                Marques
            </a>
            <a href="#about" class="hover:bg-brand-700 px-3 py-1 rounded">
                Qui sommes‑nous ?
            </a>
            <a href="/catalogue" class="hover:bg-brand-700 px-3 py-1 rounded">
                Liste de prix
            </a>

            <div class="ml-auto">
                <a href="#reseller" class="bg-accent-500 hover:bg-accent-600 px-4 py-1.5 rounded text-xs uppercase tracking-wide">
                    Devenir revendeur
                </a>
            </div>
        </div>
    </nav>
</header>

<main class="max-w-7xl mx-auto px-4 pt-0 pb-6 min-h-screen">
    @yield('content')
</main>

<footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm">
        <div class="text-slate-500 dark:text-slate-400">
            &copy; {{ date('Y') }} PC Shop - Tous droits réservés
        </div>
        <div class="flex gap-4 text-slate-500 dark:text-slate-400">
            <a href="#about" class="hover:text-brand-600">À propos</a>
            <a href="#contact" class="hover:text-brand-600">Contact</a>
            <a href="{{ route('products.index') }}" class="hover:text-brand-600">Catalogue</a>
        </div>
    </div>
</footer>

</body>
</html>