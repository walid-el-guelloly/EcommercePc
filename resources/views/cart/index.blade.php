@extends('layouts.app')

@section('title', 'Panier - PC Shop')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Votre panier</h1>

    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <p>Votre panier est vide.</p>
        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 hover:underline">
            ← Retour au catalogue
        </a>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cart as $productId => $item)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $item['name'] }}</div>
                            </td>
                            <td class="px-4 py-3">
                                {{ number_format($item['price'], 2, ',', ' ') }} €
                            </td>
                            <td class="px-4 py-3">
                                {{ $item['quantity'] }}
                            </td>
                            <td class="px-4 py-3">
                                {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} €
                            </td>
                            <td class="px-4 py-3 text-right">
                                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Retirer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold">
                            Total :
                        </td>
                        <td class="px-4 py-3 font-bold text-indigo-600">
                            {{ number_format($total, 2, ',', ' ') }} €
                        </td>
                        <td class="px-4 py-3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4 flex justify-between">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Vider le panier
                </button>
            </form>

            <button class="px-4 py-2 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                Procéder au paiement (futur)
            </button>
        </div>
    @endif
@endsection