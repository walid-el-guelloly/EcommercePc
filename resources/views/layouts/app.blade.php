<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'E-commerce pièces PC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">PC Shop</a>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600">Accueil</a>
                {{-- plus tard: lien vers panier, catégories, etc. --}}
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-10">
        <div class="max-w-6xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} PC Shop - Tous droits réservés
        </div>
    </footer>

</body>
</html>