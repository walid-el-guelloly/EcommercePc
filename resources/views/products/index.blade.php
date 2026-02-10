@extends('layouts.app')

@section('title', 'Catalogue - PC Shop')

@section('content')
    <div class="flex items-center justify-between mb-2">
        <h1 class="text-2xl font-bold">Catalogue</h1>
        @if (request('q') || request('category'))
            <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:underline">
                Réinitialiser les filtres
            </a>
        @endif
    </div>

    @if (request('q'))
        <p class="text-sm text-gray-600 mb-4">
            Résultats pour : <span class="font-semibold">"{{ request('q') }}"</span>
        </p>
    @endif
    {{-- <h1 class="text-2xl font-bold mb-6">Catalogue</h1> --}}

    @if ($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        @if ($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                class="h-full object-cover">
                        @else
                            <span class="text-gray-500 text-sm">Pas d'image</span>
                        @endif
                    </div>

                    <div class="p-4 flex-1 flex flex-col">
                        <div class="text-xs text-gray-500 mb-1">
                            {{ $product->category?->name ?? 'Sans catégorie' }}
                        </div>
                        <h2 class="text-lg font-semibold mb-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600">
                                {{ $product->name }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm flex-1">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-xl font-bold text-indigo-600">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </div>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                                    Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p>Aucun produit pour le moment.</p>
    @endif
@endsection
