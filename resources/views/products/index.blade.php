@extends('layouts.app')

@section('title', 'Catalogue - PC Shop')

@php use Illuminate\Support\Str; @endphp

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tous nos produits</h1>

    {{-- Barre filtres / tri --}}
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 mb-6 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('products.index') }}"
               class="px-3 py-1.5 rounded-full text-xs border
                      {{ request('category') ? 'border-slate-300 text-slate-600 dark:border-slate-600 dark:text-slate-300' : 'bg-brand-600 text-white border-brand-600' }}">
                Toutes les catégories
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}"
                   class="px-3 py-1.5 rounded-full text-xs border
                          {{ request('category') === $category->slug
                                ? 'bg-brand-600 text-white border-brand-600'
                                : 'border-slate-300 text-slate-600 hover:border-brand-500 hover:text-brand-600 dark:border-slate-600 dark:text-slate-300' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2 text-xs">
            {{-- On garde les autres paramètres (q, category) --}}
            @foreach(request()->except('sort', 'page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <span class="text-slate-500 dark:text-slate-300">Trier par :</span>
            <select name="sort"
                    class="rounded-full border-slate-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 text-xs focus:ring-brand-500 focus:border-brand-500">
                <option value="">Nouveautés</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
            </select>
            <button class="ml-1 px-3 py-1 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-100 text-xs">
                OK
            </button>
        </form>
    </div>

    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                @php
                    $image = null;
                    if ($product->image_path) {
                        $image = Str::startsWith($product->image_path, ['http://', 'https://'])
                            ? $product->image_path
                            : asset('storage/' . $product->image_path);
                    }
                @endphp

                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex flex-col shadow-soft hover:shadow-lg transition">
                    <div class="h-40 flex items-center justify-center mb-4">
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $product->name }}" class="max-h-full object-contain">
                        @else
                            <span class="text-xs text-slate-400">Image à venir</span>
                        @endif
                    </div>

                    <div class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-1">
                        {{ $product->category?->name ?? 'Sans catégorie' }}
                    </div>
                    <h2 class="text-sm font-semibold mb-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-brand-600">
                            {{ Str::limit($product->name, 60) }}
                        </a>
                    </h2>

                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 flex-1">
                        {{ Str::limit($product->description, 80) }}
                    </p>

                    <div class="flex items-center justify-between mt-auto pt-2">
                        <div class="text-base font-bold text-brand-600">
                            {{ number_format($product->price, 2, ',', ' ') }} €
                        </div>

                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <x-button size="sm">
                                Ajouter
                            </x-button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-sm text-slate-600 dark:text-slate-300">
            Aucun produit trouvé avec ces filtres.
        </p>
    @endif
@endsection