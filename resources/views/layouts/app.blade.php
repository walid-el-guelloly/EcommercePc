<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'E-commerce pièces PC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">

    <header
        class="sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-2xl font-extrabold text-brand-600">PC Shop</span>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm">
                <a href="#hero" data-section="hero"
                    class="nav-link text-slate-700 dark:text-slate-200 hover:text-brand-600 border-b-2 border-transparent pb-1">
                    Accueil
                </a>
                <a href="#catalogue" data-section="catalogue"
                    class="nav-link text-slate-700 dark:text-slate-200 hover:text-brand-600 border-b-2 border-transparent pb-1">
                    Catalogue
                </a>
                <a href="#about" data-section="about"
                    class="nav-link text-slate-700 dark:text-slate-200 hover:text-brand-600 border-b-2 border-transparent pb-1">
                    À propos
                </a>
                <a href="#contact" data-section="contact"
                    class="nav-link text-slate-700 dark:text-slate-200 hover:text-brand-600 border-b-2 border-transparent pb-1">
                    Contact
                </a>
            </nav>

            <div class="flex items-center gap-3">
                {{-- Panier --}}
                <a href="{{ route('cart.index') }}"
                    class="relative inline-flex items-center text-sm text-slate-700 dark:text-slate-200 hover:text-brand-600">
                    <span class="mr-1 font-semibold">Panier</span>
                    @php
                        $cart = session('cart', []);
                        $count = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    @if ($count > 0)
                        <span
                            class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-brand-600 text-white">
                            {{ $count }}
                        </span>
                    @endif
                </a>

                {{-- Liens auth --}}
                @guest
                    <a href="{{ route('login') }}" class="text-xs text-slate-700 dark:text-slate-200 hover:text-brand-600">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-xs text-white bg-brand-600 hover:bg-brand-700 px-3 py-1.5 rounded-full">
                        Inscription
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-200">
                        <span class="hidden sm:inline">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-slate-500 hover:text-red-500">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @endauth

                {{-- Toggle dark mode --}}
                <button id="theme-toggle" type="button"
                    class="px-3 py-1.5 rounded-full border border-slate-200 text-xs text-slate-700 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">
                    Mode sombre
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-6 min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700 mt-10">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm">
            <div class="text-slate-500 dark:text-slate-400">
                &copy; {{ date('Y') }} PC Shop - Tous droits réservés
            </div>
            <div class="flex gap-4 text-slate-500 dark:text-slate-400">
                <a href="{{ route('about') }}" class="hover:text-brand-600">À propos</a>
                <a href="{{ route('contact.show') }}" class="hover:text-brand-600">Contact</a>
                <a href="{{ route('products.index') }}" class="hover:text-brand-600">Catalogue</a>
            </div>
        </div>
    </footer>

</body>

</html>
