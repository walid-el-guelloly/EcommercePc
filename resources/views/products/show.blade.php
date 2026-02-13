@extends('layouts.app')

@section('title', $product->name . ' - PC Shop')

@php
    use Illuminate\Support\Str;

    $image = null;
    if ($product->image_path) {
        $image = Str::startsWith($product->image_path, ['http://', 'https://'])
            ? $product->image_path
            : asset('storage/' . $product->image_path);
    }
@endphp

@section('content')
    <div class="mb-4 text-xs text-slate-500 dark:text-slate-400">
        <a href="{{ route('products.index') }}" class="hover:text-brand-600">Catalogue</a>
        @if($product->category)
            <span class="mx-1">/</span>
            <span>{{ $product->category->name }}</span>
        @endif
    </div>

    <div class="grid md:grid-cols-2 gap-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-soft">
        {{-- Image --}}
        <div class="flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-2xl p-4">
            @if($image)
                <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-80 object-contain">
            @else
                <div class="text-gray-500">Pas d'image disponible</div>
            @endif
        </div>

        {{-- Infos produit --}}
        <div>
            @if($product->category)
                <div class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-1">
                    {{ $product->category->name }}
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-3">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-4">
                <div class="text-2xl font-bold text-brand-600">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                </div>
                @if($product->stock > 0)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200">
                        En stock ({{ $product->stock }})
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-200">
                        Rupture de stock
                    </span>
                @endif
            </div>

            <p class="text-sm text-slate-700 dark:text-slate-300 mb-5">
                {{ $product->description }}
            </p>

            {{-- Formulaire quantité + ajout panier --}}
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex items-center gap-3">
                        <label for="quantity" class="text-sm text-slate-700 dark:text-slate-200">Quantité :</label>
                        <input
                            id="quantity"
                            name="quantity"
                            type="number"
                            min="1"
                            max="{{ $product->stock }}"
                            value="1"
                            class="w-20 border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 rounded-md text-sm focus:ring-brand-500 focus:border-brand-500"
                        >
                    </div>

                    <x-button>
                        Ajouter au panier
                    </x-button>
                </form>
            @else
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Ce produit est actuellement indisponible.
                </p>
            @endif

            <hr class="my-6 border-slate-200 dark:border-slate-700">

            {{-- Infos rassurantes --}}
            <div class="grid sm:grid-cols-3 gap-4 text-xs text-slate-600 dark:text-slate-300">
                <div>
                    <div class="font-semibold mb-1">Livraison rapide</div>
                    <p>Expédition en 24/48h pour les produits en stock.</p>
                </div>
                <div>
                    <div class="font-semibold mb-1">Paiement sécurisé</div>
                    <p>Transactions protégées via nos partenaires bancaires.</p>
                </div>
                <div>
                    <div class="font-semibold mb-1">Support technique</div>
                    <p>Conseils pour choisir et monter votre configuration.</p>
                </div>
            </div>
        </div>
    </div>
@endsection