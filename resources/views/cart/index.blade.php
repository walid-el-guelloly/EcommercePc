@extends('layouts.app')

@section('title', 'Panier - PC Shop')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Votre panier</h1>

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if (empty($cart))
        <p>Votre panier est vide.</p>
        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 hover:underline">
            ← Retour au catalogue
        </a>
    @else
        <div
            class="bg-white dark:bg-slate-900 shadow rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-900 divide-y divide-slate-200 dark:divide-slate-700">
                    @foreach ($cart as $productId => $item)
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
                                    <x-button variant="outline" size="sm">
                                        Retirer
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-slate-50 dark:bg-slate-800">
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

        <div class="mt-4 flex justify-between items-center">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <x-button variant="secondary" size="sm">
                    Vider le panier
                </x-button>
            </form>

            @auth
                <a href="{{ route('checkout.show') }}">
                    <x-button>
                        Passer à la commande
                    </x-button>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:text-brand-600">
                    Connectez-vous pour finaliser votre commande
                </a>
            @endauth
        </div>
    @endif
@endsection
