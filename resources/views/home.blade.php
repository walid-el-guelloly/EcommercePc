@extends('layouts.app')

@section('title', 'PC Shop - Boutique de pièces informatiques')

@php use Illuminate\Support\Str; @endphp

@section('content')

    {{-- SECTION HERO --}}
    <section id="hero" data-section-id="hero" class="scroll-mt-24 mb-10">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-3xl px-8 py-10 text-white flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="md:w-1/2 mb-6 md:mb-0">
                <p class="text-xs uppercase tracking-wide text-indigo-200 mb-2">Nouveau • 2026</p>
                <h1 class="text-3xl md:text-4xl font-bold mb-4">
                    Montez le PC parfait avec les meilleurs composants.
                </h1>
                <p class="text-indigo-100 mb-6">
                    Processeurs, cartes graphiques, mémoire, stockage… Tout ce qu’il faut pour votre configuration gaming ou professionnelle.
                </p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#catalogue" class="inline-flex items-center justify-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-full shadow hover:bg-indigo-50">
                        Voir le catalogue
                    </a>
                    <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 border border-indigo-200 text-white font-semibold rounded-full hover:bg-indigo-700/40">
                        Besoin de conseils ?
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-center">
                <div class="relative">
                    <div class="w-64 h-40 bg-white/10 backdrop-blur rounded-2xl border border-white/20 flex items-center justify-center">
                        <span class="text-center text-sm text-indigo-100">
                            (Plus tard : visuel de configuration PC)
                        </span>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white text-indigo-700 text-xs px-3 py-2 rounded-xl shadow">
                        Livraison rapide 48h
                    </div>
                    <div class="absolute -top-4 -right-4 bg-amber-400 text-amber-900 text-xs px-3 py-1 rounded-full shadow">
                        Offres du moment
                    </div>
                </div>
            </div>
        </div>

        {{-- Recherche rapide --}}
        <div class="mt-6">
            <form action="{{ route('products.index') }}" method="GET" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm px-4 py-3 flex items-center gap-3">
                <input
                    type="text"
                    name="q"
                    placeholder="Rechercher un processeur, une carte graphique, une barrette RAM..."
                    class="flex-1 border-0 focus:ring-0 text-sm bg-transparent"
                    value="{{ request('q') }}"
                >
                <button class="px-4 py-2 bg-brand-600 text-white text-sm font-medium rounded-xl hover:bg-brand-700">
                    Rechercher
                </button>
            </form>
        </div>
    </section>

    {{-- SECTION CATALOGUE (catégories + produits) --}}
    <section id="catalogue" data-section-id="catalogue" class="scroll-mt-24 mb-12 space-y-10">
        {{-- Catégories --}}
        <div id="categories">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Catégories populaires</h2>
                <a href="{{ route('products.index') }}" class="text-sm text-brand-600 hover:underline">
                    Voir tout le catalogue →
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                       class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm hover:shadow-md transition p-4 flex flex-col items-start">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mb-3 text-sm font-semibold">
                            {{ strtoupper(substr($category->name, 0, 2)) }}
                        </div>
                        <div class="font-medium mb-1 group-hover:text-brand-600">
                            {{ $category->name }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            {{ $category->description }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Produits mis en avant --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Produits mis en avant</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>

        {{-- Nouveautés --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Nouveautés</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($newProducts as $product)
                    <x-product-card :product="$product" compact="true" :showAddButton="false" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION ABOUT --}}
    <section id="about" data-section-id="about" class="scroll-mt-24 mb-12">
        <p class="text-xs uppercase tracking-wide text-brand-600 mb-2">
            À propos
        </p>
        <h2 class="text-2xl font-bold mb-4">
            Qui sommes-nous ?
        </h2>
        <p class="text-slate-600 dark:text-slate-300 max-w-2xl mb-8">
            PC Shop est une boutique en ligne spécialisée dans les composants informatiques :
            processeurs, cartes graphiques, mémoire, stockage, cartes mères, et plus encore.
            Notre objectif : vous aider à monter le PC qui correspond exactement à vos besoins,
            que ce soit pour le gaming, la création ou un usage professionnel.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <div class="text-3xl font-bold text-brand-600 mb-1">+5 ans</div>
                <div class="text-sm font-semibold mb-1">d’expérience</div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Une expertise construite autour du matériel PC et des dernières générations de composants.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <div class="text-3xl font-bold text-brand-600 mb-1">24/7</div>
                <div class="text-sm font-semibold mb-1">boutique en ligne</div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Commandez à tout moment, avec un suivi clair de vos commandes.
                </p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                <div class="text-3xl font-bold text-brand-600 mb-1">Support</div>
                <div class="text-sm font-semibold mb-1">personnalisé</div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Nous vous aidons à choisir les bons composants compatibles entre eux.
                </p>
            </div>
        </div>
    </section>

    {{-- SECTION CONTACT --}}
    <section id="contact" data-section-id="contact" class="scroll-mt-24 mb-12">
        <p class="text-xs uppercase tracking-wide text-brand-600 mb-2">
            Contact
        </p>
        <h2 class="text-2xl font-bold mb-2">
            Contactez-nous
        </h2>
        <p class="text-slate-600 dark:text-slate-300 max-w-2xl mb-6">
            Une question sur un produit, une configuration ou une commande ?
            Remplissez le formulaire ou utilisez les informations de contact ci-dessous.
        </p>

        <div class="grid md:grid-cols-2 gap-8">
            {{-- Infos --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft">
                    <h3 class="text-lg font-semibold mb-3">Nos coordonnées</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mb-3">
                        Nous répondons généralement sous 24 à 48h les jours ouvrés.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                        <li><span class="font-semibold">Email :</span> support@pcshop.test</li>
                        <li><span class="font-semibold">Téléphone :</span> +33 1 23 45 67 89</li>
                        <li><span class="font-semibold">Horaires :</span> Lun–Ven, 9h–18h</li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5">
                    <h3 class="text-lg font-semibold mb-3">Pourquoi nous contacter ?</h3>
                    <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-300 space-y-1">
                        <li>Conseils pour choisir vos composants</li>
                        <li>Vérifier la compatibilité de votre configuration</li>
                        <li>Suivi d’une commande ou d’une livraison</li>
                        <li>Problème technique ou demande de retour</li>
                    </ul>
                </div>
            </div>

            {{-- Formulaire --}}
            <div>
                @if(session('success'))
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-5 shadow-soft space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Nom complet *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            required
                        >
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            required
                        >
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium mb-1">Sujet</label>
                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            value="{{ old('subject') }}"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                        >
                        @error('subject')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium mb-1">Message *</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-sm focus:ring-brand-500 focus:border-brand-500"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <x-button>
                            Envoyer le message
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection