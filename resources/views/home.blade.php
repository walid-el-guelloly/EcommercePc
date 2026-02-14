@extends('layouts.app')

@section('title', 'PC Shop - Boutique informatique')

@php use Illuminate\Support\Str; @endphp

@section('content')

    {{-- HERO type bannière Joutech --}}
    {{-- <section id="hero" data-section-id="hero" class="scroll-mt-32 mb-10">
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-soft">
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
                        <a href="#catalogue"
                            class="px-6 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-full hover:bg-brand-700">
                            Voir toutes les offres
                        </a>
                        <a href="#reseller"
                            class="px-6 py-2.5 border border-brand-600 text-brand-600 text-sm font-semibold rounded-full hover:bg-brand-50 dark:hover:bg-slate-800">
                            Devenir revendeur
                        </a>
                    </div>
                </div>
                <div class="bg-slate-900/5 dark:bg-slate-900 flex items-center justify-center p-6">
                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=1200&q=80"
                        alt="Laptop et périphériques" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section> --}}

    {{-- HERO --}}
    {{-- HERO --}}
    <section id="hero" data-section-id="hero" class="scroll-mt-32 mb-12">
        {{-- Conteneur full-width qui sort du max-w du <main> --}}
        <div class="relative left-1/2 right-1/2 -ml-[50vw] w-screen">
            <div
                class="relative overflow-hidden rounded-b-3xl bg-gradient-to-br from-slate-900 via-slate-950 to-brand-700 text-white shadow-soft">
                {{-- halos bleus --}}
                <div class="pointer-events-none absolute -left-32 top-0 h-80 w-80 rounded-full bg-brand-500/25 blur-3xl">
                </div>
                <div class="pointer-events-none absolute right-0 -bottom-32 h-80 w-80 rounded-full bg-sky-500/25 blur-3xl">
                </div>

                <div class="relative grid md:grid-cols-2 gap-6 px-6 md:px-10 lg:px-20 py-10 md:py-14 items-center">
                    {{-- Texte --}}
                    <div class="space-y-5 md:space-y-6">
                        <div
                            class="inline-flex items-center gap-2 rounded-full bg-brand-500/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-brand-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                            Édition spéciale 2026
                        </div>

                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                            Montez un setup PC
                            <span class="text-sky-300">puissant</span><br>
                            pour le jeu et le travail.
                        </h1>

                        <p class="text-sm md:text-base text-slate-100/85 max-w-xl">
                            Processeurs, cartes graphiques, écrans et périphériques :
                            tout ce qu’il faut pour un poste de travail fluide et un gameplay ultra‑réactif.
                        </p>

                        <div class="flex flex-wrap gap-3 pt-1">
                            <a href="#catalogue"
                                class="inline-flex items-center justify-center rounded-full bg-brand-500 px-6 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-brand-600 transition">
                                Découvrir le catalogue
                            </a>
                            <a href="#reseller"
                                class="inline-flex items-center justify-center rounded-full border border-brand-300/70 px-6 py-2.5 text-sm font-semibold text-brand-50 hover:bg-brand-500/10 transition">
                                Devenir revendeur
                            </a>
                        </div>

                        <div class="flex flex-wrap gap-3 text-[11px] text-slate-100/80 pt-3">
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-900/40 px-3 py-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                                Composants récents
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-900/40 px-3 py-1">
                                Livraison rapide
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-900/40 px-3 py-1">
                                Support configuration
                            </span>
                        </div>
                    </div>

                    {{-- Visuel produit --}}
                    <div class="relative flex justify-center md:justify-end mt-6 md:mt-0">
                        <div class="relative w-full max-w-md">
                            <div
                                class="aspect-[4/5] rounded-[2rem] bg-gradient-to-br from-slate-800/90 to-slate-900/95 border border-brand-400/40 shadow-2xl flex items-center justify-center overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1618005198919-d3d4b5a92eee?auto=format&fit=crop&w=1100&q=80"
                                    alt="Setup PC moderne" class="h-full w-full object-cover object-center">
                            </div>

                            {{-- badge en haut à droite --}}
                            <div
                                class="absolute -top-4 right-4 rounded-full bg-slate-900/80 px-3 py-1 text-[11px] text-brand-100 border border-brand-400/50 shadow-md">
                                Configs gaming & pro
                            </div>

                            {{-- carte info en bas --}}
                            <div
                                class="absolute -bottom-5 left-6 right-6 rounded-2xl bg-slate-900/90 backdrop-blur px-4 py-3 text-xs text-slate-100/90 border border-slate-700/80 shadow-lg">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <div class="font-semibold text-[12px]">Sélection PC Shop</div>
                                        <div class="text-[11px] text-slate-300">
                                            Composants compatibles, prêts à être assemblés.
                                        </div>
                                    </div>
                                    <div class="text-right text-[11px] text-slate-300">
                                        Jusqu’à<br>
                                        <span class="font-semibold text-sky-300">24 mois</span><br>de garantie
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- fin full-width --}}
    </section>

    {{-- SECTION NOUVEAUTÉS --}}
    {{-- SECTION NOUVEAUTÉS --}}
    <section id="catalogue" data-section-id="catalogue" class="scroll-mt-32 mb-12">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">
                <span class="text-slate-800 dark:text-slate-100">Les </span>
                <span class="text-brand-500">Nouveautés</span>
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
                Découvrez les dernières technologies de pointe dans nos nouveaux produits.
            </p>
        </div>

        <div class="relative -mx-4">
            {{-- Bouton précédent --}}
            <button id="new-prev" type="button"
                class="hidden md:flex absolute inset-y-0 left-0 z-10 items-center justify-center w-10
                   bg-gradient-to-r from-slate-950/80 via-slate-950/40 to-transparent
                   text-slate-100 hover:text-white focus:outline-none"
                aria-label="Produits précédents">
                <span
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-900/80 border border-slate-700 text-sm">
                    ‹
                </span>
            </button>

            {{-- Liste horizontale --}}
            <div id="new-products-slider"
                class="flex gap-4 overflow-x-auto pb-4 px-4 no-scrollbar snap-x snap-mandatory scroll-smooth">
                @foreach ($newProducts as $product)
                    @php
                        // use Illuminate\Support\Str;
                        $image = null;
                        if ($product->image_path) {
                            $image = Str::startsWith($product->image_path, ['http://', 'https://'])
                                ? $product->image_path
                                : asset('storage/' . $product->image_path);
                        }
                    @endphp

                    <div data-product-card="1"
                        class="min-w-[220px] max-w-[260px] flex-shrink-0 snap-start
                           bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800
                           rounded-2xl p-6 flex flex-col items-center shadow-soft hover:shadow-lg transition">
                        <div class="h-32 flex items-center justify-center mb-4">
                            @if ($image)
                                <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-full object-contain">
                            @else
                                <span class="text-xs text-slate-400">Image à venir</span>
                            @endif
                        </div>

                        <h3 class="text-sm font-semibold text-center mb-2 text-slate-900 dark:text-slate-100">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-brand-500">
                                {{ Str::limit($product->name, 50) }}
                            </a>
                        </h3>
                        <div class="text-base font-bold text-brand-500 mb-3">
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

            {{-- Bouton suivant --}}
            <button id="new-next" type="button"
                class="hidden md:flex absolute inset-y-0 right-0 z-10 items-center justify-center w-10
                   bg-gradient-to-l from-slate-950/80 via-slate-950/40 to-transparent
                   text-slate-100 hover:text-white focus:outline-none"
                aria-label="Produits suivants">
                <span
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-900/80 border border-slate-700 text-sm">
                    ›
                </span>
            </button>
        </div>
    </section>

    {{-- BLOC "DEVENIR REVENDEUR" & AVANTAGES --}}
    <section id="reseller" data-section-id="reseller" class="scroll-mt-32 mb-12">
        <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-soft text-center mb-6">
            <h2 class="text-2xl font-bold mb-3">
                Devenir Revendeur <span class="text-brand-600">PC Shop</span>.
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mb-5 max-w-3xl mx-auto">
                Vous êtes revendeur ou professionnel de l'informatique ?
                Rejoignez notre réseau et bénéficiez de conditions avantageuses sur l’ensemble de nos produits.
            </p>
            {{-- <x-button href="#about">
                Plus d’informations
            </x-button> --}}
            <a href="#about"
                class="px-6 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-full hover:bg-brand-700">
                Plus d’informations
            </a>
        </div>

        {{-- <div id="pricing" class="grid md:grid-cols-3 gap-6">
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
        </div> --}}
    </section>

    {{-- On garde ABOUT & CONTACT comme tu les avais déjà, éventuellement en bas --}}
    @include('partials.about-and-contact')

@endsection
