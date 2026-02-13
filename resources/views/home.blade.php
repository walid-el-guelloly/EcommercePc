@extends('layouts.app')

@section('title', 'PC Shop - Boutique informatique')

@php use Illuminate\Support\Str; @endphp

@section('content')

    {{-- HERO type bannière Joutech --}}
    <section id="hero" data-section-id="hero" class="scroll-mt-32 mb-10">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-soft">
            <div class="grid md:grid-cols-2">
                <div class="p-8 flex flex-col justify-center">
                    <p class="text-xs uppercase tracking-wide text-brand-600 mb-2">
                        Nouveautés 2026
                    </p>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">
                        Laptops & composants pour booster vos performances.
                    </h1>
                    <p class="text-slate-600 dark:text-slate-300 mb-6">
                        Découvrez une sélection de PC portables, processeurs, cartes graphiques et périphériques
                        pour le gaming et le travail.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#catalogue" class="px-6 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-full hover:bg-brand-700">
                            Voir toutes les offres
                        </a>
                        <a href="#reseller" class="px-6 py-2.5 border border-brand-600 text-brand-600 text-sm font-semibold rounded-full hover:bg-brand-50 dark:hover:bg-slate-800">
                            Devenir revendeur
                        </a>
                    </div>
                </div>
                <div class="bg-slate-900/5 dark:bg-slate-900 flex items-center justify-center p-6">
                    <img
                        src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=1200&q=80"
                        alt="Laptop et périphériques"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION NOUVEAUTÉS --}}
    <section id="catalogue" data-section-id="catalogue" class="scroll-mt-32 mb-12">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">
                <span class="text-slate-800 dark:text-slate-100">Les </span>
                <span class="text-brand-600">Nouveautés</span>
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
                Découvrez les dernières technologies de pointe dans nos nouveaux produits.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($newProducts as $product)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 flex flex-col items-center shadow-soft hover:shadow-lg transition">
                    @php
                        $image = null;
                        if ($product->image_path) {
                            $image = Str::startsWith($product->image_path, ['http://', 'https://'])
                                ? $product->image_path
                                : asset('storage/' . $product->image_path);
                        }
                    @endphp

                    <div class="h-32 flex items-center justify-center mb-4">
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-full object-contain">
                        @else
                            <span class="text-xs text-slate-400">Image à venir</span>
                        @endif
                    </div>

                    <h3 class="text-sm font-semibold text-center mb-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-brand-600">
                            {{ Str::limit($product->name, 50) }}
                        </a>
                    </h3>
                    <div class="text-base font-bold text-brand-600 mb-3">
                        {{ number_format($product->price, 2, ',', ' ') }} €
                    </div>

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto">
                        @csrf
                        <x-button size="sm">
                            Ajouter au panier
                        </x-button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    {{-- BLOC "DEVENIR REVENDEUR" & AVANTAGES --}}
    <section id="reseller" data-section-id="reseller" class="scroll-mt-32 mb-12">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-soft text-center mb-6">
            <h2 class="text-2xl font-bold mb-3">
                Devenir Revendeur <span class="text-brand-600">PC Shop</span>.
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mb-5 max-w-3xl mx-auto">
                Vous êtes revendeur ou professionnel de l'informatique ?
                Rejoignez notre réseau et bénéficiez de conditions avantageuses sur l’ensemble de nos produits.
            </p>
            <x-button>
                Plus d’informations
            </x-button>
        </div>

        <div id="pricing" class="grid md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Livraison partout</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Livraison rapide où que vous soyez, pour vous ou vos clients.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Catalogue riche</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Une large sélection de composants, PC portables et périphériques.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5">
                <h3 class="font-semibold mb-2">Paiement sécurisé</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    Vos transactions sont protégées grâce à nos partenaires de paiement.
                </p>
            </div>
        </div>
    </section>

    {{-- On garde ABOUT & CONTACT comme tu les avais déjà, éventuellement en bas --}}
    @include('partials.about-and-contact')

@endsection