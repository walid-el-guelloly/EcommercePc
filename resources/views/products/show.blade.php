@extends('layouts.app')

@section('title', $product->name . ' - PC Shop')

@section('content')
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white shadow rounded-lg p-4 flex items-center justify-center">
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                    class="max-h-80 object-contain">
            @else
                <div class="text-gray-500">Pas d'image disponible</div>
            @endif
        </div>

        <div>
            <div class="text-sm text-gray-500 mb-2">
                {{ $product->category?->name }}
            </div>
            <h1 class="text-2xl font-bold mb-3">{{ $product->name }}</h1>

            <div class="text-2xl text-indigo-600 font-bold mb-4">
                {{ number_format($product->price, 2, ',', ' ') }} €
            </div>

            <p class="text-gray-700 mb-4">
                {{ $product->description }}
            </p>

            <div class="mb-4">
                @if ($product->stock > 0)
                    <span class="inline-block px-3 py-1 text-sm bg-green-100 text-green-700 rounded">
                        En stock ({{ $product->stock }})
                    </span>
                @else
                    <span class="inline-block px-3 py-1 text-sm bg-red-100 text-red-700 rounded">
                        Rupture de stock
                    </span>
                @endif
            </div>

            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                @csrf
                <div class="flex items-center gap-3 mb-4">
                    <label for="quantity" class="text-sm text-gray-700">Quantité :</label>
                    <input id="quantity" name="quantity" type="number" min="1" value="1"
                        class="w-20 border-gray-300 rounded-md shadow-sm">
                </div>
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Ajouter au panier
                </button>
            </form>
        </div>
    </div>
@endsection
