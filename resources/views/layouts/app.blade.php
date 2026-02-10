<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'E-commerce pièces PC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-gray-900">

<header class="sticky top-0 z-30 bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="text-2xl font-extrabold text-indigo-600">PC Shop</span>
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">
                Accueil
            </a>
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600">
                Catalogue
            </a>
        </nav>

        <div class="flex items-center gap-4">
            {{-- Panier avec compteur --}}
            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center text-sm text-gray-700 hover:text-indigo-600">
                <span class="material-symbols-outlined text-xl mr-1">shopping_cart</span>
                <span>Panier</span>
                @php
                    $cart = session('cart', []);
                    $count = array_sum(array_column($cart, 'quantity'));
                @endphp
                @if($count > 0)
                    <span class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full bg-indigo-600 text-white">
                        {{ $count }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-6">
    @yield('content')
</main>

<footer class="bg-white border-t mt-10">
    <div class="max-w-7xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} PC Shop - Tous droits réservés
    </div>
</footer>

</body>
</html>