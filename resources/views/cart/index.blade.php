@extends('layouts.app')

@section('title', 'Panier - PC Shop')

@section('content')
    {{-- Bandeau étapes --}}
    <x-checkout-steps current="cart" />

    <div class="mt-6">
        <h1 class="text-2xl font-bold mb-4">Mon panier</h1>

        @if(session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        @if($errors->has('checkout'))
            <x-alert type="error">
                {{ $errors->first('checkout') }}
            </x-alert>
        @endif

        @if(empty($cart))
            <p>Votre panier est vide.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-brand-600 hover:underline text-sm">
                ← Retour au catalogue
            </a>
        @else
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Liste produits --}}
                <div class="md:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <div class="grid grid-cols-[2fr_1fr] text-xs text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700 pb-2 mb-3">
                        <span>Produit</span>
                        <span class="text-right">Total</span>
                    </div>

                    <div class="space-y-4">
                        @foreach($cart as $productId => $item)
                            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                                <div>
                                    <div class="text-sm font-semibold mb-1">
                                        {{ $item['name'] }}
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $item['quantity'] }} × {{ number_format($item['price'], 2, ',', ' ') }} €
                                    </div>
                                    <form action="{{ route('cart.remove', $productId) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="text-xs text-red-500 hover:underline">
                                            Supprimer l’élément
                                        </button>
                                    </form>
                                </div>
                                <div class="text-sm font-semibold text-brand-600 dark:text-brand-200">
                                    {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Résumé panier --}}
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-soft">
                    <h2 class="text-lg font-semibold mb-4">Total panier</h2>

                    <div class="flex items-center justify-between text-sm mb-2">
                        <span>Sous‑total</span>
                        <span>{{ number_format($total, 2, ',', ' ') }} €</span>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-2">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>

                    <hr class="my-3 border-slate-200 dark:border-slate-700">

                    <div class="flex items-center justify-between mb-4">
                        <div class="text-sm text-slate-500 dark:text-slate-400">
                            Total estimé
                        </div>
                        <div class="text-xl font-bold text-brand-600 dark:text-brand-200">
                            {{ number_format($total, 2, ',', ' ') }} €
                        </div>
                    </div>

                    <div class="space-y-3">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <x-button variant="secondary" size="sm" class="w-full justify-center">
                                Vider le panier
                            </x-button>
                        </form>

                        @auth
                            <a href="{{ route('checkout.show') }}">
                                <x-button class="w-full justify-center">
                                    Valider la commande
                                </x-button>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block text-xs text-slate-500 hover:text-brand-600 text-center">
                                Connectez‑vous pour finaliser votre commande
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection