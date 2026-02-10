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
        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" class="h-full" />
                @endforeach
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @else
            <p>Aucun produit pour le moment.</p>
        @endif

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p>Aucun produit pour le moment.</p>
    @endif
@endsection
