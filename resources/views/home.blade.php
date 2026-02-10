@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('title', 'PC Shop - Boutique de pièces informatiques')

@section('content')
    {{-- Hero --}}
    <section
        class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-3xl px-8 py-10 mb-10 text-white flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="md:w-1/2 mb-6 md:mb-0">
            <p class="text-sm uppercase tracking-wide text-indigo-200 mb-2">Nouveau • 2026</p>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Montez le PC parfait avec les meilleurs composants.
            </h1>
            <p class="text-indigo-100 mb-6">
                Processeurs, cartes graphiques, mémoire, stockage… Tout ce qu’il faut pour votre configuration gaming ou
                professionnelle.
            </p>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-full shadow hover:bg-indigo-50">
                    Voir le catalogue
                </a>
                <a href="#categories"
                    class="inline-flex items-center justify-center px-6 py-3 border border-indigo-200 text-white font-semibold rounded-full hover:bg-indigo-700/40">
                    Découvrir les catégories
                </a>
            </div>
        </div>

        <div class="md:w-1/2 flex justify-center">
            <div class="relative">
                <div
                    class="w-64 h-40 bg-white/10 backdrop-blur rounded-2xl border border-white/20 flex items-center justify-center">
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
    </section>

    {{-- Recherche rapide --}}
    <section class="mb-10">
        <form action="{{ route('products.index') }}" method="GET"
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm px-4 py-3 flex items-center gap-3">
            <input type="text" name="q"
                placeholder="Rechercher un processeur, une carte graphique, une barrette RAM..."
                class="flex-1 border-0 focus:ring-0 text-sm" value="{{ request('q') }}">
            <button class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700">
                Rechercher
            </button>
        </form>
    </section>

    {{-- Catégories --}}
    <section id="categories" class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Catégories populaires</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">
                Voir tout le catalogue →
            </a>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="group bg-white rounded-2xl shadow-sm hover:shadow-md transition p-4 flex flex-col items-start">
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mb-3 text-sm font-semibold">
                        {{ strtoupper(substr($category->name, 0, 2)) }}
                    </div>
                    <div class="font-medium mb-1 group-hover:text-indigo-600">
                        {{ $category->name }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $category->description }}
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Produits mis en avant --}}
    <section class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Produits mis en avant</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    {{-- Nouveautés --}}
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Nouveautés</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($newProducts as $product)
                <x-product-card :product="$product" compact="true" :showAddButton="false" />
            @endforeach
        </div>
    </section>
@endsection
